import threading
import simpleaudio as sa
import logging
from flask import Flask, Response
from time import sleep
from os import path

thread = None
stop_flag = False
    
app = Flask(__name__)
handler = logging.FileHandler('app.log')
formatter = logging.Formatter("%(asctime)s - %(levelname)s - %(message)s")
handler.setFormatter(formatter)
app.logger.setLevel(logging.INFO)
app.logger.addHandler(handler)


@app.route('/start/')
@app.route('/start/<alert>')
@app.route('/start/<alert>/<int:delay>')
def start(alert = None, delay = 0):
    global thread
    global stop_flag
    if not alert:
        app.logger.warning("Received /start call with no alert specified")
        js = '{"status":"error", "reason":"Missing alert and/or delay input"}'
        res = Response(js, status=400, mimetype='application/json')
        
    elif not path.isfile("audio/" + alert + ".wav"):
        app.logger.warning("Received /start call with invalid alert name")
        js = '{"status":"error", "reason":"No file exists with that name"}'
        res = Response(js, status=400, mimetype='application/json')
        
    else:   
        if not thread:
            js = '{"status":"success", "reason":"Started playback of audio"}'
        
        else:
            app.logger.info("Stopping playback to switch to new audio file")
            stopAudio()
            js = '{"status":"success", "reason":"Switched audio playback"}'
        
        res = Response(js, status=202, mimetype='application/json')
        thread = threading.Thread(target=loopAudio, args=(alert, delay,
                lambda: stop_flag))
        app.logger.info("Starting playback of file " + alert)
        thread.start()

    return res


@app.route('/stop')
def stop():
    result = stopAudio()
    if result == 202:
        js = '{"status":"success", "reason":"Playback requested to stop"}'
        res = Response(js, status=202, mimetype='application/json')
    elif result == 200:
        js = '{"status":"success", "reason":"No audio currently being played"}'
        res = Response(js, status=200, mimetype='application/json')
    else:
        js = '{"status":"error", "reason":"Unknown response from stopAudio"}'
        res = Response(js, status=500, mimetype='application/json')
    return res

    
def stopAudio():
    global thread
    global stop_flag
    if thread:
        stop_flag = True
        sa.stop_all()
        thread.join()
        thread = None
        stop_flag = False
        app.logger.info("Successfully stopped audio playback")
        return 202
    else:
        app.logger.info("No audio was playing")
        return 200


def loopAudio(alert, loop_delay, stop):  
    wave_obj = sa.WaveObject.from_wave_file("audio/" + alert + ".wav")
    app.logger.info("Started audio loop of file " + alert)
    while True:
        play_obj = wave_obj.play()
        play_obj.wait_done()
        if stop():
            return

        # Loop sleep by individual seconds to offer faster interrupts
        for i in range(0, loop_delay):
            sleep(1)
            if stop():
                return # Uses return to break out of outer loop
                
               
def authenticated(token):
    # TODO: Add authentication method
    return True

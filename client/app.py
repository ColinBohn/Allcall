import threading
import simpleaudio as sa
from flask import Flask, Response
from time import sleep
from os import path

thread = None
stop_flag = False
app = Flask(__name__)

@app.route('/start/')
@app.route('/start/<alert>')
@app.route('/start/<alert>/<int:delay>')
def start(alert = None, delay = 0):
    global thread
    global stop_flag
    if not alert:
        js = '{"status": "error", "reason": "Missing alert and/or delay input"}'
        res = Response(js, status=400, mimetype='application/json')
    elif not path.isfile("audio/" + alert + ".wav"):
        js = '{"status": "error", "reason": "No file exists with that name"}'
        res = Response(js, status=400, mimetype='application/json')
    elif not thread:
        thread = threading.Thread(target=loopAudio, args=(alert+".wav", delay,
                lambda: stop_flag))
        thread.start()
        js = '{"status": "success", "reason": "Started playback of audio"}'
        res = Response(js, status=200, mimetype='application/json')
    else:
        js = '{"status": "error", "reason": "Already playing audio"}'
        res = Response(js, status=409, mimetype='application/json')
    return res


@app.route('/stop')
def stop():
    result = stopAudio()
    if result == 202:
        js = '{"status": "success", "reason": "Playback requested to stop"}'
        res = Response(js, status=202, mimetype='application/json')
    elif result == 200:
        js = '{"status": "success", "reason": "No audio currently being played"}'
        res = Response(js, status=200, mimetype='application/json')
    else:
        js = '{"status": "error", "reason": "Unknown response from stopAudio"}'
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
        return 202
    else:
        return 200    

def loopAudio(filename, loop_delay, stop):  
    wave_obj = sa.WaveObject.from_wave_file("audio/" + filename)
    while True:
        play_obj = wave_obj.play()
        play_obj.wait_done()
        if stop():
            return

        for i in range(0, loop_delay):
            sleep(1)
            if stop():
                return # Uses return to break out of outer loop
                
def authenticated(token):
    # TODO: Add authentication method
    return True
    

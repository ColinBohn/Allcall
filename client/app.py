import threading
import simpleaudio as sa
import logging
from flask import Flask, Response, jsonify, request
from time import sleep
from os import path, environ
from functools import wraps


playing = None
thread = None
stop_flag = False

app = Flask(__name__)
handler = logging.FileHandler('app.log')
formatter = logging.Formatter("%(asctime)s - %(levelname)s - %(message)s")
handler.setFormatter(formatter)
app.logger.setLevel(logging.INFO)
app.logger.addHandler(handler)

def authenticated(f):
    @wraps(f)
    def decorated(*args, **kwargs):
        header = request.headers.get('X-AllCall-Key')
        key = environ.get('ALLCALL_NODE_KEY')
        if not key or not header or not header == key:
            return jsonify({"status" : "error",
                    "response" : "Not authenticated properly"}), 401
        return f(*args, **kwargs)
    return decorated

@app.route('/')
@app.route('/ping')
def ping():
     return jsonify({"status" : "success", "response" : "pong"})
    
@app.route('/status')
@authenticated
def status():
    if not thread:
        return jsonify({"status" : "success", "response" : "Idle"})
    else:
        global playing
        return jsonify({"status" : "success",
                "response" : "Playing " + playing })

@app.route('/start/')
@app.route('/start/<alert>')
@app.route('/start/<alert>/<int:delay>')
@authenticated
def start(alert = None, delay = 0):
    global thread
    global stop_flag
    if not alert:
        app.logger.warning("Received /start call with no alert specified")
        return jsonify({"status" : "error",
                "response" : "Missing alert and/or delay input"}), 400
        
    elif not path.isfile("audio/" + alert + ".wav"):
        app.logger.warning("Received /start call with invalid alert name")
        return jsonify({"status" : "error",
                "response" : "No file exists with that name"}), 400
        
    else:   
        if not thread:
            json = jsonify({"status" : "success",
                    "response" : "Started playback of audio"})
        
        else:
            app.logger.info("Stopping playback to switch to new audio file")
            stopAudio()
            json = jsonify({"status" : "success",
                    "response" : "Switched audio playback"})
        
        thread = threading.Thread(target=loopAudio, args=(alert, delay,
                lambda: stop_flag))
        app.logger.info("Starting playback of file " + alert)
        thread.start()
        return json


@app.route('/stop')
@authenticated
def stop():
    stopped = stopAudio()
    if stopped:
        return jsonify({"status" : "success",
                "response" : "Playback requested to stop"})
    else:
        return jsonify({"status" : "success",
                "response" : "No audio currently being played"})

    
def stopAudio():
    global playing
    global thread
    global stop_flag
    if thread:
        stop_flag = True
        sa.stop_all()
        thread.join()
        thread = None
        playing = None
        stop_flag = False
        app.logger.info("Successfully stopped audio playback")
        return True
    else:
        app.logger.info("No audio was playing")
        return False


def loopAudio(alert, loop_delay, stop):
    global playing
    playing = alert
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

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8080)

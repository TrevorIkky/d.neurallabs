from flask import Flask,request,jsonify
import PIL
import os
from array import array
from keras.models import model_from_json
from tensorflow import keras
from keras.preprocessing import image
import numpy as np
import cv2
import urllib
 
app = Flask(__name__)
app.config['UPLOAD_EXTENSIONS'] = ['.jpg', '.png']
 
@app.route('/tb-analyzer', methods=['POST'])
def tb():
    model_successful = False
    try:
        if request.form is not None and "url" in request.form:
            url = request.form["url"]
 
            model = keras.models.load_model('model.h5')
 
            req = urllib.request.urlopen(url)
            arr = np.asarray(bytearray(req.read()), dtype=np.uint8)
 
            img = cv2.imdecode(arr, -1)
            img = cv2.resize(img, (300, 300))
            img_arr = np.array(img).reshape(1,300,300,1)
 
            response = model.predict(img_arr)
            model_successful = True
        else :
            response = "URL Error"
 
    except Exception as e:
        response = str(e)
 
    response = response.tolist() if model_successful else response
    return jsonify({'Prediction ' : response})
 
 
if __name__ == '__main__':
    app.run(host="0.0.0.0")
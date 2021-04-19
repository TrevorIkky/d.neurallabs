from flask import Flask,request,jsonify
import PIL
import os
from array import array
from keras.models import model_from_json
from tensorflow import keras
from keras.preprocessing import image

import numpy as np
import cv2

app = Flask(__name__)
app.config['UPLOAD_EXTENSIONS'] = ['.jpg', '.png']

@app.route('/')
def home():
    return "Flask running"

@app.route('/tb-analyzer', methods=['POST'])
def tb():
    xray_image = request.files['xray_image']
    if xray_image.filename != '':
        xray_image.save(xray_image.filename)

    model = keras.models.load_model('model.h5')

    img  = cv2.imread(xray_image.filename, cv2.IMREAD_GRAYSCALE)
    img = cv2.resize(img, (300, 300))
    img_arr = np.array(img).reshape(1,300,300,1)

    response = model.predict(img_arr)

    return jsonify({'Prediction ' : response.tolist()})

if __name__ == '__main__':
    app.run(host='0.0.0.0')
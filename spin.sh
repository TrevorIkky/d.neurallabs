#!/bin/bash
app="neurallabs.ml"
docker build -t ${app} .
docker run -d -p 5001:5000 --name ${app} -v $PWD:/app ${app}

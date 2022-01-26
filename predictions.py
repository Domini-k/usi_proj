from tensorflow import keras
import json


json_file = open("saved_input.json")
input = json.load(json_file)
json_file.close()

model = keras.models.load_model('my_model')
prediction = str(model.predict([input])[0][0]*100)

data_to_save = (prediction + " %")
with open('saved_prediction.json', 'w') as file_object:
    json.dump(data_to_save, file_object)

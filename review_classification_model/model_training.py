import os
import tensorflow as tf
import tensorflow_datasets as tfds
import tensorflow_hub as hub
from keras.callbacks import ModelCheckpoint
from tensorflow import keras
from model_initialization import train_data, validation_data, filepath, callbacks_list
from numpy.testing import assert_allclose
from keras.models import Sequential, load_model
from keras.layers import LSTM, Dropout, Dense
from keras.callbacks import ModelCheckpoint
# This file loads saved model, trins it and saves again | Epochs can be set

set_epochs = 15

loaded_model = load_model(filepath)

# Train the model with the new callback
# TRAINING THE MODEL

loaded_model.fit(train_data.shuffle(10000).batch(512),
                 epochs=set_epochs,
                 validation_data=validation_data.batch(512),
                 verbose=1, callbacks=callbacks_list)

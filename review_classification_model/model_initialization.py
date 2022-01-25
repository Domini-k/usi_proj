import tensorflow as tf
import tensorflow_datasets as tfds
import tensorflow_hub as hub
from keras.callbacks import ModelCheckpoint

# This file initializes model and saves it to file after 5 epochs of training

train_data, validation_data, test_data = tfds.load(
    'imdb_reviews', split=['train[60%:]', 'train[:40%]', 'test'], as_supervised=True)

train_examples_batch, train_labels_batch = next(iter(train_data.batch(10)))

pretrained_model = "https://tfhub.dev/google/tf2-preview/gnews-swivel-20dim/1"

hub_layer = hub.KerasLayer(
    pretrained_model, input_shape=[], dtype=tf.string, trainable=True)

model = tf.keras.Sequential()
model.add(hub_layer)
model.add(tf.keras.layers.Dense(16, activation="relu"))
model.add(tf.keras.layers.Dense(1, activation="sigmoid"))

# model.summary()

model.compile(optimizer='adam',
              loss='binary_crossentropy',
              metrics=['accuracy'])


filepath = "review_classification_model/model_file.h5"
checkpoint = ModelCheckpoint(
    filepath, monitor='loss', verbose=1, save_best_only=True, mode='min')
callbacks_list = [checkpoint]


# TRAINING THE MODEL once just to save it in a file
model.fit(train_data.shuffle(10000).batch(512),
          epochs=5,
          validation_data=validation_data.batch(512),
          verbose=1, callbacks=callbacks_list)

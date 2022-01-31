import tensorflow as tf
import tensorflow_datasets as tfds
import tensorflow_hub as hub

# This file initializes model and saves it to file after 1 epoch of training

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


model.compile(optimizer='adam',
              loss='binary_crossentropy',
              metrics=['accuracy'])

# TRAINING THE MODEL once just to save it in a file
model.fit(train_data.shuffle(10000).batch(512),
          epochs=1,
          validation_data=validation_data.batch(512),
          verbose=1)


model.save('my_model')

print("saved")

from tensorflow import keras
import tensorflow_datasets as tfds

train_data, validation_data, test_data = tfds.load(
    'imdb_reviews', split=['train[60%:]', 'train[:40%]', 'test'], as_supervised=True)

model = keras.models.load_model('my_model')

model.fit(train_data.shuffle(10000).batch(512),
          epochs=15,
          validation_data=validation_data.batch(512),
          verbose=1)

model.save('my_model')

print("saved")

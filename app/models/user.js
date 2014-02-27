var Mongoose, ObjectId, Schema, schema;

Mongoose = require('mongoose');

Schema = Mongoose.Schema;

ObjectId = Schema.ObjectId;

schema = new Schema({
  name: {
    type: String,
    required: true,
    unique: true
  },
  password: {
    type: String,
    required: true
  },
  salt: {
    type: String,
    required: true
  },
  ideas: {
    type: ObjectId,
    ref: 'Idea'
  }
});

module.exports = Mongoose.model('User', schema);

var Mongoose, ObjectId, Schema, bcrypt, schema;

Mongoose = require('mongoose');

Schema = Mongoose.Schema;

ObjectId = Schema.ObjectId;

bcrypt = require('bcrypt');

schema = new Schema({
  name: {
    type: String,
    required: true,
    unique: true
  },
  salt: {
    type: String,
    required: true
  },
  password: {
    type: String,
    required: true
  },
  ideas: [
    {
      id: ObjectId,
      name: {
        type: String,
        unique: true
      },
      description: String,
      progress: Number,
      started: Boolean,
      finished: Boolean
    }
  ]
});

schema.methods.authenticate = function(password, cb) {
  var passHash;
  passHash = this.password;
  return bcrypt.hash(password, this.salt, function(err, hash) {
    if (err) {
      cb(err);
    }
    return bcrypt.compare(password, passHash, function(err, match) {
      if (err) {
        cb(err);
      }
      return cb(null, match);
    });
  });
};

module.exports = Mongoose.model('users', schema);

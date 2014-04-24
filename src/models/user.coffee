Mongoose = require 'mongoose'
Schema = Mongoose.Schema
ObjectId = Schema.ObjectId
bcrypt = require 'bcrypt'

schema = new Schema
    name: 
        type: String
        required: true
        unique: true
    salt:
        type: String
        required: true
    password: 
        type: String
        required: true
    ideas: [
        id: ObjectId
        name: 
            type: String
            unique: true
        description: String
        progress: Number
        started: Boolean
        finished: Boolean
    ]

schema.methods.authenticate = (password, cb) ->
    passHash = @password
    bcrypt.hash password, @salt, (err, hash) ->
        cb(err) if err

        bcrypt.compare password, passHash, (err, match) ->
            cb(err) if err
            cb null, match

module.exports = Mongoose.model 'users', schema

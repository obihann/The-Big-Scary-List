Mongoose = require 'mongoose'
Schema = Mongoose.Schema
ObjectId = Schema.ObjectId

schema = new Schema
    name: 
        type: String
        required: true
        unique: true
    password: 
        type: String
        required: true
    ideas:
        type: ObjectId
        ref: 'ideas'

module.exports = Mongoose.model 'users', schema

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

module.exports = Mongoose.model 'users', schema

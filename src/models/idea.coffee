Mongoose = require 'mongoose'
Schema = Mongoose.Schema
ObjectId = Schema.ObjectId

schema = new Schema
    user: 
        type: ObjectId
        ref: 'users'
    name: String
    description: String
    progress: Number
    started: Boolean
    finished: Boolean

module.exports = Mongoose.model 'ideas', schema

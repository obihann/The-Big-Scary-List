config         = require './config'
express        = require 'express'
partials       = require 'express-partials'
mongoose       = require 'mongoose'
app            = module.exports = express()

app.configure 'local', () ->
    mongoose.connect config.mongo.local

app.configure 'dev', () ->
    mongoose.connect config.mongo.dev

app.configure () ->
    app.set 'views', __dirname + '/views'
    app.set 'view engine', 'jade'

    app.use express.json()
    app.use express.urlencoded()
    app.use partials()
    app.use express.static __dirname + '/public'
    app.use app.router

# load router
require("./routes/index") app

# load site
port = process.env.PORT || 8000

app.listen port, () ->
    console.log 'Weere Up!' + port

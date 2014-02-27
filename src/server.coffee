config         = require './config'
express        = require 'express'
partials       = require 'express-partials'
mongoose       = require 'mongoose'
app            = module.exports = express()

app.configure () ->
    mongoose.connect config.mongo.local

    app.set 'views', __dirname + '/views'
    app.set 'view engine', 'jade'

    app.use partials()
    app.use express.static __dirname + '/public'
    app.use app.router

# load router
require("./routes/index") app

# load site
port = 8080

app.listen port, () ->
    console.log 'Weere Up!' + port

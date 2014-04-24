config         = require './config'
express        = require 'express'
partials       = require 'express-partials'
passport       = require 'passport'
LocalStrategy  = require('passport-local').Strategy
mongoose       = require 'mongoose'
MongoStore     = require('connect-mongo') express
app            = module.exports = express()
Users          = require './models/user'

app.configure 'local', () ->
    mongoose.connect config.mongo.local

    app.use express.errorHandler
        dumpExceptions: true
        showStack: true

app.configure 'dev', () ->
    mongoose.connect config.mongo.dev

    app.use express.errorHandler
        dumpExceptions: true
        showStack: true

app.configure () ->
    app.set 'views', __dirname + '/views'
    app.set 'view engine', 'jade'

    app.use partials()

    app.use express.json()
    app.use express.urlencoded()
    app.use express.static __dirname + '/public'
    app.use express.cookieParser config.session.secret
    app.use express.bodyParser()

    console.log app.get('env')

    app.use express.session
        config: config.session.secret
        cookie:
            maxAge: 3600000 
        store: new MongoStore
            url: config.mongo[app.get 'env']
            auto_reconnect: true
    
    app.use passport.initialize()
    app.use passport.session()

    app.use app.router

passport.use new LocalStrategy (username, password, done) ->
    Users.findOne({name: username}).exec (err, user) ->
        done(err) if err

        user.authenticate password, (err, match) ->
            done(err) if err
            done(null, false) unless match
            done(null, user)

passport.serializeUser (user, done) ->
    done null, user._id

passport.deserializeUser (user, done) ->
    done null, user


# load router
require("./routes/index") app

# load site
port = process.env.PORT || 8000

app.listen port, () ->
    console.log 'Weere Up!' + port

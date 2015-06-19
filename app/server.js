var LocalStrategy, MongoStore, Users, app, config, express, mongoose, partials, passport, port;

config = require('./config');

express = require('express');

partials = require('express-partials');

passport = require('passport');

LocalStrategy = require('passport-local').Strategy;

mongoose = require('mongoose');

MongoStore = require('connect-mongo')(express);

app = module.exports = express();

Users = require('./models/user');

app.configure('local', function() {
  mongoose.connect(config.mongo.local);
  return app.use(express.errorHandler({
    dumpExceptions: true,
    showStack: true
  }));
});

app.configure('dev', function() {
  mongoose.connect(config.mongo.dev);
  return app.use(express.errorHandler({
    dumpExceptions: true,
    showStack: true
  }));
});

app.configure(function() {
  app.set('views', __dirname + '/views');
  app.set('view engine', 'jade');
  app.use(partials());
  app.use(express.json());
  app.use(express.urlencoded());
  app.use(express["static"](__dirname + '/public'));
  app.use(express.cookieParser(config.session.secret));
  app.use(express.bodyParser());
  console.log(app.get('env'));
  app.use(express.session({
    config: config.session.secret,
    cookie: {
      maxAge: 3600000
    },
    store: new MongoStore({
      url: config.mongo[app.get('env')],
      auto_reconnect: true
    })
  }));
  app.use(passport.initialize());
  app.use(passport.session());
  return app.use(app.router);
});

passport.use(new LocalStrategy(function(username, password, done) {
  return Users.findOne({
    name: username
  }).exec(function(err, user) {
    if (err) {
      done(err);
    }
    return user.authenticate(password, function(err, match) {
      if (err) {
        done(err);
      }
      if (!match) {
        done(null, false);
      }
      return done(null, user);
    });
  });
}));

passport.serializeUser(function(user, done) {
  return done(null, user._id);
});

passport.deserializeUser(function(user, done) {
  return done(null, user);
});

require("./routes/index")(app);

port = process.env.PORT || 8000;

app.listen(port, function() {
  return console.log('Weere Up!' + port);
});

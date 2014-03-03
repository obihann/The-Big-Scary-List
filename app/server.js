var app, config, express, mongoose, partials, port;

config = require('./config');

express = require('express');

partials = require('express-partials');

mongoose = require('mongoose');

app = module.exports = express();

app.configure(function() {
  mongoose.connect(config.mongo.local);
  app.set('views', __dirname + '/views');
  app.set('view engine', 'jade');
  app.use(express.json());
  app.use(express.urlencoded());
  app.use(partials());
  app.use(express["static"](__dirname + '/public'));
  return app.use(app.router);
});

require("./routes/index")(app);

port = 8080;

app.listen(port, function() {
  return console.log('Weere Up!' + port);
});

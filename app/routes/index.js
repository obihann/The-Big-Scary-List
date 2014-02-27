var http, router;

http = require('http');

router = function(app) {
  var controller;
  controller = require('../controllers/index')(app);
  return {
    idea: require('./idea')(app, http, controller)
  };
};

module.exports = router;

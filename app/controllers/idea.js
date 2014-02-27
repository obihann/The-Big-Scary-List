var Idea, User, config, ideaController;

config = require('../config');

Idea = require('../models/idea');

User = require('../models/user');

ideaController = function(app) {
  return {
    ideas: function(req, res) {
      return res.render('ideas', {
        layout: 'layout'
      });
    }
  };
};

module.exports = ideaController;

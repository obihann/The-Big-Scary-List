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
    },
    idea: function(req, res) {},
    "new": function(req, res) {},
    "delete": function(req, res) {},
    update: function(req, res) {}
  };
};

module.exports = ideaController;

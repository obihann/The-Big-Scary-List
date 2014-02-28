var Ideas, Users, config, ideaController, _;

config = require('../config');

_ = require('underscore');

Ideas = require('../models/idea');

Users = require('../models/user');

ideaController = function(app) {
  return {
    ideas: function(req, res) {
      return Ideas.find({}).exec(function(err, ideas) {
        var completed, stated;
        completed = [];
        stated = [];
        return res.render('ideas', {
          layout: 'layout',
          ideas: ideas
        });
      });
    },
    idea: function(req, res) {},
    "new": function(req, res) {},
    "delete": function(req, res) {},
    update: function(req, res) {}
  };
};

module.exports = ideaController;

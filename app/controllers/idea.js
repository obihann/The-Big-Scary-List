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
    newIdeaPage: function(req, res) {
      return res.render('ideas-new', {
        layout: 'layout'
      });
    },
    idea: function(req, res) {},
    "new": function(req, res) {
      var data, idea;
      data = req.body;
      idea = new Ideas({
        name: data.idea,
        description: data.description,
        user: '5310aa29df63c208a6000001'
      });
      return idea.save(function(err) {
        if (err) {
          console.log(err);
        }
        return res.redirect('/');
      });
    },
    "delete": function(req, res) {},
    update: function(req, res) {}
  };
};

module.exports = ideaController;

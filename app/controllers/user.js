var Users, config, userController, _;

config = require('../config');

_ = require('underscore');

Users = require('../models/user');

userController = function(app) {
  return {
    index: function(req, res) {
      return res.render('index', {
        layout: 'layout'
      });
    },
    login: function(req, res) {
      if (req.user) {
        return res.redirect('/ideas/' + req.user._id);
      } else {
        return res.redirect('/login');
      }
    },
    register: function(req, res) {
      var data, hash, salt, user;
      data = req.body;
      salt = bcrypt.genSaltSync(10);
      hash = bcrypt.hashSync(data.password, salt);
      user = new Users({
        name: data.username,
        salt: salt,
        password: hash
      });
      return user.save(function(err) {
        if (err) {
          console.log(err);
        }
        return res.redirect('/');
      });
    },
    loginPage: function(req, res) {
      return res.render('login', {
        layout: 'layout'
      });
    },
    ideas: function(req, res) {
      var user_id;
      user_id = req.params.id;
      return Users.findOne({
        _id: user_id
      }).exec(function(err, user) {
        return res.render('ideas', {
          layout: 'layout',
          ideas: user.ideas
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
      var data, user_id;
      if (!req.user) {
        res.redirect('/login');
      }
      data = req.body;
      user_id = req.user;
      return Users.findOne({
        _id: user_id
      }).exec(function(err, user) {
        var idea;
        if (err) {
          console.log(err);
        }
        idea = {
          name: data.idea,
          description: data.description,
          user: user
        };
        user.ideas.push(idea);
        return user.save(function(err) {
          if (err) {
            console.log(err);
          }
          return res.redirect('/ideas/' + req.user);
        });
      });
    },
    "delete": function(req, res) {},
    update: function(req, res) {},
    start: function(req, res) {
      var user_id;
      if (!req.user) {
        res.redirect('/login');
      }
      user_id = req.user;
      return Users.findOne({
        _id: user_id
      }).exec(function(err, user) {
        var idea;
        if (err) {
          console.log(err);
        }
        idea = _.find(user.ideas, function(idea) {
          return idea._id.valueOf() === req.params.id;
        });
        console.log(idea);
        if (idea) {
          console.log(idea);
          idea.started = true;
          return user.save(function(err) {
            if (err) {
              console.log(err);
            }
            return res.redirect('/');
          });
        }
      });
    },
    finish: function(req, res) {}
  };
};

module.exports = userController;

config = require '../config'
_ = require 'underscore'
bcrypt = require 'bcrypt'
Users = require '../models/user'

userController = (app) ->
    index: (req, res) ->
        res.render 'index',
            layout: 'layout'

    register: (req, res) ->
        data = req.body
        salt = bcrypt.genSaltSync 10
        hash = bcrypt.hashSync data.password, salt

        user = new Users
           name: data.username
           salt: salt
           password: hash

        user.save (err) ->
            console.log err if err

            res.redirect '/'

    loginPage: (req, res) ->
        res.render 'login',
            layout: 'layout'

    ideas: (req, res) ->
        user_id = '5310aa29df63c208a6000001'
        Users.findOne({_id: user_id}).exec (err, user) ->
            res.render 'ideas',
                layout: 'layout'
                ideas: user.ideas

    newIdeaPage: (req, res) ->
        res.render 'ideas-new',
            layout: 'layout'

    idea: (req, res) ->

    new: (req, res) ->
        data = req.body
        user_id = '5310aa29df63c208a6000001'
        Users.findOne({_id: user_id}).exec (err, user) ->
            console.log err if err

            idea =
                name: data.idea
                description: data.description
                user: user 

            user.ideas.push idea

            user.save (err) ->
                console.log err if err
                res.redirect '/'

    delete: (req, res) ->

    update: (req, res) ->

    start: (req, res) ->
        user_id = '5310aa29df63c208a6000001'
        Users.findOne({_id: user_id}).exec (err, user) ->
            console.log err if err

            idea = _.find user.ideas, (idea) ->
                idea._id.valueOf() is req.params.id

            console.log idea
            if idea
                console.log idea
                idea.started = true

                user.save (err) ->
                    console.log err if err
                    res.redirect '/'

    finish: (req, res) ->

module.exports = userController

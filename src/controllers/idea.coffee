config = require '../config'
_ = require 'underscore'
Ideas = require '../models/idea'
Users = require '../models/user'

ideaController = (app) ->
    ideas: (req, res) ->
        Ideas.find({}).exec (err, ideas) ->
            completed = []
            stated = []

            res.render 'ideas',
                layout: 'layout'
                ideas: ideas

    newIdeaPage: (req, res) ->
        res.render 'ideas-new',
            layout: 'layout'

    idea: (req, res) ->

    new: (req, res) ->
        data = req.body

        idea = new Ideas
            name: data.idea
            description: data.description
            user: '5310aa29df63c208a6000001'

        idea.save (err) ->
            console.log err if err
            res.redirect '/'

    delete: (req, res) ->

    update: (req, res) ->

module.exports = ideaController

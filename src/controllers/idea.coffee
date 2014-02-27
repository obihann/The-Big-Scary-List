config = require '../config'
Idea = require '../models/idea'
User = require '../models/user'

ideaController = (app) ->
    ideas: (req, res) ->
        res.render 'ideas',
            layout: 'layout'

    idea: (req, res) ->

    new: (req, res) ->

    delete: (req, res) ->

    update: (req, res) ->

module.exports = ideaController

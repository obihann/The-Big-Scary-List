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

    idea: (req, res) ->

    new: (req, res) ->

    delete: (req, res) ->

    update: (req, res) ->

module.exports = ideaController

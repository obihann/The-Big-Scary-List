config = require '../config'
Idea = require '../models/idea'
User = require '../models/user'

ideaController = (app) ->
    ideas: (req, res) ->
        res.render 'ideas',
            layout: 'layout'

module.exports = ideaController

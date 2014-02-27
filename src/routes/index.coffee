http = require 'http'

router = (app) ->
    idea = require('../controllers/idea') app

    console.log idea
    app.get '/', idea.ideas

module.exports = router

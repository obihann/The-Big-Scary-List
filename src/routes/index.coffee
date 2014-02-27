http = require 'http'

router = (app) ->
    controller = require('../controllers/index') app
    idea: require('./idea') app, http, controller

module.exports = router

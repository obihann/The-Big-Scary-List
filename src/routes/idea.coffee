router = (app, http, controller) ->
    app.get '/', controller.idea.ideas
    app.get '/idea', controller.idea.idea
    app.get '/new-idea', controller.idea.newIdeaPage

    app.post '/idea/new', controller.idea.new
    app.post '/idea/delete', controller.idea.delete
    app.post '/idea/update', controller.idea.update

module.exports = router

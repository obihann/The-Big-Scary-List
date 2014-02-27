var http, router;

http = require('http');

router = function(app) {
  var idea;
  idea = require('../controllers/idea')(app);
  console.log(idea);
  return app.get('/', idea.ideas);
};

module.exports = router;

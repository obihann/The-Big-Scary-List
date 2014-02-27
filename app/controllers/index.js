var controllers;

controllers = function(app) {
  return {
    idea: require('./idea')(app)
  };
};

module.exports = controllers;

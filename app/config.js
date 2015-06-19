var config;

config = {
  mongo: {
    local: 'mongodb://localhost/bigscarylist',
    dev: 'mongodb://list:bigscary@oceanic.mongohq.com:10098/bigscarylist'
  },
  session: {
    secret: 'hj;jh23;kjh4;kljh234'
  }
};

module.exports = config;

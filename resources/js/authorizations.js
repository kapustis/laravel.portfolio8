let user = window.user;

module.exports = {
  owns (model, prop = 'user_id') {
    return model[prop] === user.id;
  },

  isAdmin(){
    return ['Admin', 'UserOne'].includes(user.name)
  }
}


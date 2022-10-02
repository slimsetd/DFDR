//to handle mutations
const mutations = {
  SET_USERS(state, users) {
    state.users = users;
  },
  SAVE_JSON(state, data) {
    state.json = data;
  }
};

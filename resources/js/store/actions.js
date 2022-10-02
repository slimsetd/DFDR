//to handle actions
const actions = {
  getUsers({ commit }) {
    axios.get("/api/user").then((response) => {
      commit("SET_USERS", response.data.data.user);
    });
  },

  getJson({ commit },data) {
    console.log(data);
    axios.get("/api/user").then((response) => {
      commit("SET_USERS", response.data.data.user);
    });
  },
 
};

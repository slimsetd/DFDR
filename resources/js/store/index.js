// import dependency to handle HTTP request to our back end
import axios from "axios";
import Vuex from "vuex";
import Vue from "vue";
import { reject } from "lodash";

Vue.use(Vuex);
//to handle state
const state = {
  token: localStorage.getItem("token") || "",
  status: "",
  json: "",
  json_id: "",
  user: {},
  loading: true,
  users: [],
  departments: [],
  faculties: [],
  data: [],
  years: [],
  categories: [],
  degrees: [],
  subject: [],
  divisions: [],
  languages: [],
  news: [],
  myupload: [],
  uploadedfile: [],
  uploadedfileapproved: [],
};

//to handle state
const getters = {
  getAllUsers: (state) => state.users,
  getAllDepartments: (state) => state.departments,
  getAllFaculties: (state) => state.faculties,
  getAllCreator: (state) => state.data,
  getAllYears: (state) => state.years,
  getAllCategories: (state) => state.categories,
  getAllDegrees: (state) => state.degrees,
  getAllDivisions: (state) => state.divisions,
  getAllLanguages: (state) => state.languages,
  getAllNews: (state) => state.news,
  getLoading: (state) => state.loading,
  isLoggedIn: (state) => !!state.token,
  authStatus: (state) => state.status,
  getMyUpload: (state) => state.myupload,
  getUploadedFile: (state) => state.uploadedfile,
  getUploadedFileApproved: (state) => state.uploadedfileapproved,
  getAllSubject: (state) => state.subject,
};

//to handle actions
const actions = {
  postLogin({ commit }, user) {
    return new Promise((resolve, reject) => {
      commit("AUTH_REQUEST");
      axios
        .post("/api/login", user)
        .then((res) => {
          console.log(res.data.status == "false");
          if (res.data.status == "false") {
            Vue.swal({
              icon: "error",
              title: "Login Error!",
              text: res.data.message,
            });
          } else {
            const token = res.data.data.token;
            const user = res.data.data.user;
            const user_id = res.data.data.user.id;
            const role = res.data.data.user.role;
            localStorage.setItem("token", token);
            localStorage.setItem("user", JSON.stringify(user));
            localStorage.setItem("user_id", user_id);
            localStorage.setItem("role", role);
            axios.defaults.headers.common["Authorization"] = token;
            commit("AUTH_SUCCESS", token, user);
            resolve(res);
          }
        })
        .catch((err) => {
          commit("AUTH_ERROR");
          localStorage.removeItem("token");
          reject(err);
        });
    });
  },

  getLogout({ commit }) {
    return new Promise((resolve, reject) => {
      axios.post("/api/logout").then((response) => {
        commit("AUTH_LOGOUT");
        localStorage.clear();
        delete axios.defaults.headers.common["Authorization"];
        resolve();
      });
    });
  },

  getUsers({ commit }) {
    // axios.get("/api/user").then((response) => {
    axios.get("/api/user/main").then((response) => {
      commit("SET_USERS", response.data.data.user);
    });
  },


  getJson({ commit },payload) {
    let data = {
      id: payload.id,
      data: payload.data,
    }
    // axios.get("/api/user").then((response) => {
      commit("SET_JSON", data);
    // });
  },

  getEditor({ commit }) {
    axios.get("/api/user/editor").then((response) => {
      commit("SET_USERS", response.data.data.user);
    });
  },

  getUserDeposit({ commit }) {
    axios.get("/api/user/contribution").then((response) => {
      console.log(response);
      commit("SET_USERS", response.data.data.user);
    });
  },

  getDepartments({ commit }) {
    axios.get("/api/department").then((response) => {
      commit("SET_DEPARTMENT", response.data.data.department);
    });
  },

  getFaculties({ commit }) {
    axios.get("/api/faculty").then((response) => {
      commit("SET_FACULTY", response.data.data.Faculty);
    });
  },

  getCreator({ commit }) {
    axios.get("/api/creators").then((response) => {
      // console.log(response.data.data.data);
      commit("SET_CREATOR", response.data.data.data);
    });
  },

  getYears({ commit }) {
    axios.get("/api/year").then((response) => {
      commit("SET_YEAR", response.data.data.year);
    });
  },

  getCategory({ commit }) {
    axios.get("/api/category").then((response) => {
      // console.log(response.data.data.category);
      commit("SET_CATEGORY", response.data.data.category);
    });
  },

  getDegree({ commit }) {
    axios.get("/api/degree").then((response) => {
      commit("SET_DEGREE", response.data.data.degree);
    });
  },

  getDivision({ commit }) {
    axios.get("/api/division").then((response) => {
      commit("SET_DIVISION", response.data.data.division);
    });
  },

  getSubject({ commit }) {
    axios.get("/api/subject").then((response) => {
      commit("SET_SUBJECT", response.data.data.subject);
    });
  },

  getLanguage({ commit }) {
    axios.get("/api/language").then((response) => {
      console.log(response);
      commit("SET_LANGUAGE", response.data.data.language);
    });
  },

  getNews({ commit }) {
    axios.get("/api/news").then((response) => {
      console.log(response);
      commit("SET_NEWS", response.data.data.news);
    });
  },

  getMyUpload({ commit }) {
    axios.get("/api/upload-form/user").then((response) => {
      console.log(response);
      commit("SET_MYUPLOAD", response.data.data.form);
    });
  },

  getUploadedFile({ commit }) {
    axios.get("/api/upload-form").then((response) => {
      // console.log(response);
      commit("SET_UPLOADEDFILE", response.data.data.form);
    });
  },

  getUploadedFileRead({ commit }) {
    axios.get("/api/upload-form/search/status/Approved").then((response) => {
      // console.log(response);
      commit("SET_UPLOADEDFILE", response.data.data.form);
    });
  },

  getUploadedFileMonthly({ commit }) {
    axios.get("/api/upload-form/month").then((response) => {
      console.log(response.data.data);
      commit("SET_UPLOADEDFILE", response.data.data.form);
    });
  },

  getUploadedFileApproved({ commit }) {
    axios.get("/api/upload-form/search/status/Approved").then((response) => {
      // console.log(response);
      commit("SET_UPLOADEDFILEAPPROVED", response.data.data.form);
    });
  },
};

//to handle mutations
const mutations = {
  AUTH_REQUEST(state) {
    state.status = "loading";
  },
  AUTH_ERROR() {
    state.status = "error";
  },
  AUTH_SUCCESS(state, token, user) {
    state.token = token;
    state.status = "success";
    state.user = user;
  },
  AUTH_LOGOUT(state) {
    state.token = "";
    state.user = "";
    state.status = "";
  },
  SET_USERS(state, users) {
    state.loading = false;
    state.users = users;
  },
  SET_DEPARTMENT(state, departments) {
    state.departments = departments;
  },
  SET_FACULTY(state, faculties) {
    state.faculties = faculties;
  },
  SET_CREATOR(state, data) {
    state.data = data;
  },
  SET_YEAR(state, years) {
    state.years = years;
  },
  SET_CATEGORY(state, categories) {
    state.categories = categories;
  },
  SET_DEGREE(state, degrees) {
    state.degrees = degrees;
  },
  SET_DIVISION(state, divisions) {
    state.divisions = divisions;
  },
  SET_LANGUAGE(state, languages) {
    state.languages = languages;
  },
  SET_SUBJECT(state, subject) {
    state.subject = subject;
  },
  SET_NEWS(state, news) {
    state.news = news;
  },
  SET_MYUPLOAD(state, myupload) {
    state.myupload = myupload;
  },
  SET_UPLOADEDFILE(state, uploadedfile) {
    state.uploadedfile = uploadedfile;
  },
  SET_UPLOADEDFILEAPPROVED(state, uploadedfileapproved) {
    state.uploadedfileapproved = uploadedfileapproved;
  },
  SET_JSON(state, data) {
    state.json = data.data;
    state.json_id = data.id;
  }
};

//export store module
export default new Vuex.Store({
  state,
  getters,
  actions,
  mutations,
});
/** we have just created a boiler plate for our vuex store module**/

require("./bootstrap");

window.Vue = require("vue").default;
import router from "./router";
import Vuelidate from "vuelidate";
import Vue from "vue";
import VueSweetalert2 from "vue-sweetalert2";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
// If you don't need the styles, do not connect
import "sweetalert2/dist/sweetalert2.min.css";
// Import Bootstrap an BootstrapVue CSS files (order is important)
// import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import store from "./store";
import Vue2Editor from "vue2-editor";
import VueYouTubeEmbed from 'vue-youtube-embed'

Vue.use(VueYouTubeEmbed, { global: true, componentId: "youtube-media" })


Vue.use(Vue2Editor);
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
Vue.use(Vuelidate);
Vue.use(VueSweetalert2);


Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component("loading-component", require("./components/loading.vue").default);
Vue.component(
    "user-management-detail-component",
    require("./pages/admin/details/UserManagementDetail.vue").default
);
Vue.component(
    "sidebar-user-component",
    require("./components/SideBarUserComponent.vue").default
);
Vue.component(
    "header-user-component",
    require("./components/HeaderUserComponent.vue").default
);
Vue.component(
    "header-component",
    require("./components/HeaderComponent.vue").default
);
Vue.component(
    "footer-component",
    require("./components/FooterComponent.vue").default
);
Vue.component(
    "authside-component",
    require("./components/AuthSidebarComponent.vue").default
);
Vue.component(
    "sidesubmission-component",
    require("./components/SidebarSubmissionComponent.vue").default
);
Vue.component(
    "usermenu-component",
    require("./components/UserMenuComponent.vue").default
);

const app = new Vue({
    router,
    store,
    el: "#app",
});
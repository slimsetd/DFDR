<template>
  <div>
    <div id="accordion">
      <div class="card">
        <div
          id="menu1"
          class="card-header"
          data-toggle="collapse"
          data-target="#collapseMenu1"
          aria-expanded="true"
          aria-controls="collapseMenu1"
          style="cursor: pointer"
        >
          <h5>
            <p class="float-left mb-0" style="margin: 0; padding: 0;">
              My Account
            </p>
            <span class="material-icons float-right"
              ><span class="material-icons-outlined">
                expand_more
              </span></span
            >
          </h5>
        </div>

        <div
          id="collapseMenu1"
          class="collapse"
          aria-labelledby="menu1"
          data-parent="#accordion"
        >
          <div class="card-body" style="padding: 0; margin: 0;">
            <ul class="nav-ul" style="padding: 0; margin: 0;">
              <li>
                <a class="nav-link" v-on:click="handlingLogout()">Logout</a>
              </li>
              <li>
                <router-link :to="{ name: 'Register' }" class="nav-link"
                  >Profile</router-link
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card">
        <div
          id="menu2"
          class="card-header"
          data-toggle="collapse"
          data-target="#collapsemenu2"
          aria-expanded="true"
          aria-controls="collapsemenu2"
          style="cursor: pointer"
        >
          <h5>
            <p class="float-left mb-0" style="margin: 0; padding: 0;">
              Menu 1
            </p>
            <span class="material-icons float-right"
              ><span class="material-icons-outlined">
                expand_more
              </span></span
            >
          </h5>
        </div>

        <div
          id="collapsemenu2"
          class="collapse"
          aria-labelledby="menu2"
          data-parent="#accordion"
        >
          <div class="card-body" style="padding: 0; margin: 0;">
            <ul class="nav-ul" style="padding: 0; margin: 0;">
              <li>
                <a class="nav-link"> Logout</a>
                <router-link :to="{ name: 'Login' }" class="nav-link"
                  >Logout</router-link
                >
              </li>
              <li>
                <router-link :to="{ name: 'Register' }" class="nav-link"
                  >Profile</router-link
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    handlingLogout() {
      var vm = this;
      localStorage.clear();
      Vue.swal({
        icon: "success",
        title: "Logout Berhasil!",
        text: "Sampai Jumpa ! ",
      });
      vm.$router.push("/home");
      console.log("login");
    },
  },
};
</script>

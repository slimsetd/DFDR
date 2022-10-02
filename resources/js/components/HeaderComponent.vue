<template>
  <div>
    <div class="jumbotron bg-blue">
      <p class="logo-campus-text" v-html="header"></p>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-grey">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <router-link :to="{ name: 'Homepage' }" class="nav-link"
              >Home</router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'DescSubmission' }" class="nav-link"
              >Submissions</router-link
            >
          </li>
          <!-- <li class="nav-item">
            <router-link :to="{ name: 'SubmissionFilter' }" class="nav-link"
              >Submission</router-link
            >
          </li> -->
          <li class="nav-item">
            <router-link :to="{ name: 'About' }" class="nav-link"
              >About</router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'Contact' }" class="nav-link"
              >Contact</router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'Login' }" class="nav-link"
              >Login</router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'Register' }" class="nav-link"
              >Register</router-link
            >
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'HeaderComponent',
  data() {
    return {
      header: null,
    };
  },
  methods: {
    getHeader() {
      axios.get('/api/template/home/1').then(response => {
        this.header = response.data.data.content;
      });
    }
  },
  created () {
    this.getHeader();
  },
}
</script>

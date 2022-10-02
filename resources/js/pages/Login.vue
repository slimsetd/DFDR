<template>
<div class="jumbotron">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-sm-12 col-xs-12">
        <div
          class="card"
          style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;"
        >
          <div class="card-body">
            <h3 class="text-center" style="margin-bottom:30px;">Log<b>In</b></h3>
            <div class="container">
              <form>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    aria-describedby="emailHelp"
                    placeholder="Type your email.."
                    v-model="form.email"
                  />
                  <!-- <small id="emailHelp" class="form-text text-muted"
                    >We'll never share your email with anyone else.</small> -->
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    placeholder="Type your password.."
                    v-model="form.password"
                  />
                  <small>
                    <router-link :to="{ name: 'ForgotPassword' }" class="form-text float-right">
                      Forgot Password?
                    </router-link>
                  </small>
                </div>
                <!-- <div class="form-group"> -->
                  <!-- <a href="">Lupa Password?</a> -->
                  
                <!-- </div> -->
                <div class="form-group" style="margin-top: 50px;">
                  <button
                    type="submit"
                    class="btn btn-primary btn-block bg-blue"
                    v-on:click.prevent="handleLogin()"
                  >
                    Login
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
    };
  },
  mounted() {},

  methods: {
    handleLogin() {
      console.log("clicked");
      let email = this.form.email;
      let password = this.form.password;
      this.$store
        .dispatch("postLogin", { email, password })
        .then((res) => {
          // console.log(res);
          if (localStorage.getItem("role") == "Editor") {
            this.$router.push("/my-upload").then(() => {
              window.location.reload();
            });
          } else if (
            localStorage.getItem("role") == "Admin" ||
            localStorage.getItem("role") == "User"
          ) {
            this.$router.push("/dashboard").then(() => {
              window.location.reload();
            });
          }
        })
        .catch((err) => {
          Vue.swal({
            icon: "error",
            title: "Login Error!",
            text: "Please check your account activation or login data",
          });
          console.log(err);
        });
    },
  },
};
</script>

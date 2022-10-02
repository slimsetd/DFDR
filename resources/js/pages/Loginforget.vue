<template>
<div class="jumbotron">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div
          class="card"
          style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;"
        >
          <div class="card-body">
            <h3 class="text-center" style="margin-bottom:30px;">Forgot <b>Password</b></h3>
            <div class="container">
              <form>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    aria-describedby="emailError"
                    placeholder="Type your email.."
                    v-model="form.email"
                    v-on:change="checkEmail()"
                  />
                  <small 
                    id="emailError" 
                    class="form-text text-muted-b"
                    v-if="!submitted && !$v.form.email.required"
                  >
                    <i class="fa fa-bell text-xs"></i>&nbsp; We will send a notification <b>Reset</b> to your email
                  </small>
                  <small 
                    id="emailError" 
                    class="form-text text-muted"
                    v-if="submitted && !$v.form.email.required"
                  >
                    <i class="fa fa-info-circle text-xs"></i>&nbsp; Email is required
                  </small>
                  <small 
                    id="emailError" 
                    class="form-text text-muted"
                    v-if="$v.form.email.required && !existEmail"
                  >
                    <i class="fa fa-times text-xs"></i>&nbsp; Email is not registered, please re-check your email
                  </small>
                </div>
                
                <div class="form-group" style="margin-top: 30px;">
                  <button
                    type="submit"
                    class="btn btn-primary btn-block bg-blue"
                    v-on:click.prevent="onClick()"
                  >
                    Confirm
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

<style>
  .text-muted {
    color: red !important;
  }
  .text-muted-b{
    color:rgb(99, 142, 160) !important;
  }
</style>

<script>
import { required, email } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      form: {
        email: "",
      },
      submitted: false,
      existEmail: false,
    };
  },
  validations: {
    form: {
      email: { required, email }
    },
  },
  mounted() {},

  methods: {
    checkEmail() {
      if (this.form.email != "")
      {
        let formData = new FormData();
        formData.append("email", this.form.email);

        axios.post("/api/user/checkEmail", formData)
        .then((res) => {
          // console.log(res);
          if(res.data.status == "Success")
            this.existEmail = false;
          else
            this.existEmail = true;
        })
        .catch((err) => {
          console.log(err);
        });
      }
      else
        this.existEmail = false;
    },

    onClick() {
      this.submitted = true;

      if (this.form.email != "")
      {
        if (this.existEmail)
        {
          let formData = new FormData();
          formData.append("email", this.form.email);

          axios
            .post("/api/user/reqResetPass", formData)
            .then((res) => {
              // console.log(res);
              // if(res.data.status == "Success")
              //   this.existEmail = false;
              // else
              //   this.existEmail = true;
              Vue.swal({
                icon: "success",
                title: "Request Has Been Sent!",
                text: "Please check your email inbox for further notice",
              });
              this.$router.push("/login");
            })
            .catch((err) => {
              console.log(err);
            });
        }
        else
        {
          Vue.swal({
            icon: "warning",
            title: "Email "+ this.form.email + " is not Registered on Sistem!",
          });
        }
      }
    },

    // handleLogin() {
    //   console.log("clicked");
    //   let email = this.form.email;
    //   let password = this.form.password;
    //   this.$store
    //     .dispatch("postLogin", { email, password })
    //     .then((res) => {
    //       // console.log(res);
    //       if (localStorage.getItem("role") == "Editor") {
    //         this.$router.push("/my-upload").then(() => {
    //           window.location.reload();
    //         });
    //       } else if (
    //         localStorage.getItem("role") == "Admin" ||
    //         localStorage.getItem("role") == "User"
    //       ) {
    //         this.$router.push("/dashboard").then(() => {
    //           window.location.reload();
    //         });
    //       }
    //     })
    //     .catch((err) => {
    //       Vue.swal({
    //         icon: "error",
    //         title: "Login Error!",
    //         text: "Please check your account activation or login data",
    //       });
    //       console.log(err);
    //     });
    // },
  },
};
</script>

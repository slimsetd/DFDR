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
            <h3 class="text-center" style="margin-bottom:30px;">Reset <b>Password</b></h3>
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
                  />
                  <small 
                    id="emailError" 
                    class="form-text text-muted"
                    v-if="submitted && !$v.form.email.required"
                  >
                    <i class="fa fa-info-circle text-xs"></i>&nbsp; Email is required
                  </small>
                </div>
                <div class="form-group">
                  <label for="email">Reset Code</label>
                  <input
                    type="password"
                    class="form-control"
                    aria-describedby="resetError"
                    placeholder="Type reset code.."
                    v-model="form.rescode"
                    v-on:change.prevent="checkReset()"
                  />
                  <small 
                    id="resetError" 
                    class="form-text text-muted"
                    v-if="submitted && !$v.form.rescode.required"
                  >
                    <i class="fa fa-info-circle text-xs"></i>&nbsp; Reset Code is required
                  </small>
                </div>
                <div class="form-group">
                  <label for="email">New Password</label>
                  <input
                    type="password"
                    class="form-control"
                    v-model="form.newPass"
                    aria-describedby="newpassError"
                    placeholder="Type new password.."
                    v-on:change.prevent=""
                  />
                  <small
                    id="newpassError"
                    class="form-text text-muted"
                    v-if="submitted && !$v.form.newPass.required"
                  >
                    <i class="fa fa-info-circle text-xs"></i>&nbsp; New Password is required
                  </small>
                  <!-- <small
                    id="newpassError"
                    class="form-text text-muted-y"
                    v-if="!$v.form.newPass.minLength"
                    ><i class="fa fa-lock text-xs"></i>&nbsp; Password tidak boleh kurang dari 10 character</small
                  > -->
                  <input
                    type="password"
                    style="margin-top:10px;"
                    class="form-control"
                    v-model="form.reNewPass"
                    aria-describedby="renewpassError"
                    placeholder="Re-Type new password.."
                    v-on:change.prevent=""
                  />
                  <small
                    id="renewpassError"
                    class="form-text text-muted"
                    v-if="submitted && !$v.form.reNewPass.required"
                    ><i class="fa fa-info-circle text-xs"></i>&nbsp; New Password is required</small
                  >
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
        rescode: "",
        newPass: "",
        reNewPass: "",
      },
      submitted: false,
      existCode: false,
    };
  },
  validations: {
    form: {
      email: { required },
      rescode: { required },
      newPass: { required },
      reNewPass: { required },
    },
  },
  mounted() {},

  methods: {
    checkReset() {
      if (this.form.rescode != "" && this.form.email != "")
      {
        let formData = new FormData();
        formData.append("email", this.form.email);
        formData.append("code", this.form.rescode);
        

        axios.post("/api/user/checkCode", formData)
        .then((res) => {
          // console.log(res.data.status);
          if(res.data.status == "Success")
            this.existCode = true;
          else
            this.existCode = false;

          // console.log(this.existCode);
        })
        .catch((err) => {
          console.log(err);
        });
      }
      else
        this.existCode = false;
    },

    onClick() {
      this.submitted = true;

      if (this.form.rescode != "")
      {
        if (this.existCode)
        {
          let formData = new FormData();
          formData.append("email", this.form.email);
          formData.append("code", this.form.rescode);
          formData.append("password", this.form.newPass);
          formData.append("newPass", this.form.reNewPass);

          axios
            .post("/api/user/resetPass", formData)
            .then((res) => {
              // console.log(res);
              Vue.swal({
                icon: "success",
                title: "Password Has Been Changed!",
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
            title: "Reset Code is not Valid!",
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

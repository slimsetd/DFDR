<template>
  <div class="width-page" style="width:50%;">
    <!-- <header-component></header-component> -->
    <!-- <div style="margin-bottom: 0px;">
      <router-view></router-view>
    </div>
    <footer-component></footer-component> -->
    <div class="container-fluid mt-4 mb-4">
      <div class="row">
        <div class="col-md-12 mt-2">
          <div class="card p-4">
            <div class="card-body">
              <h4 class="text-center">Welcome to <b>Digital Repository Framework</b></h4>
              <p class="text-justify mt-2 mb-5 small text-center">
                Thank you for installing Digital Repository Framework! We need to set up Master Admin Account before you exploring further.
                Please fill up form below and click finish to continue.
              </p>
              
              <hr style="border-top: 1px dashed #dadada;">

              <div class="mt-3">
                <form>
                  <div class="form-group">
                    <label for="name">Full Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      name="name"
                      v-model="form.name"
                      aria-describedby="nameError"
                      placeholder="John Doe"
                    />
                    <small
                      id="nameError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.name.required"
                      ><i class="fa fa-info-circle text-xs"></i>&nbsp; Name is required</small
                    >
                    <!-- <small
                      id="nameError"
                      class="form-text text-muted-y"
                      v-if="sameName && $v.form.name.required"
                      >Nama yang sama telah terdaftar. Jika terdapat perbedaan pada data lainnya abaikan notifikasi ini</small
                    > -->
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input
                      type="number"
                      class="form-control"
                      id="phone"
                      v-model="form.phone"
                      name="phone"
                      aria-describedby="phoneError"
                      placeholder="62081100001234"
                    />
                    <small
                      id="phoneError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.phone.required"
                      ><i class="fa fa-info-circle text-xs"></i>&nbsp; Phone Number is required</small
                    >
                    <small
                      id="phoneError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.phone.minLength"
                      ><i class="fa fa-info-circle text-xs"></i>&nbsp; Phone Number should not less than 10 digits</small
                    >
                  </div>
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      name="email"
                      v-model="form.email"
                      aria-describedby="emailError"
                      placeholder="Johndoe@mail.com"
                    />
                    <small
                      id="emailError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.email.required"
                      ><i class="fa fa-info-circle text-xs"></i>&nbsp; Email is required</small
                    >
                    <small
                      id="emailError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.email.email"
                      ><i class="fa fa-info-circle text-xs"></i>&nbsp; Email is not valid</small
                    >
                    <!-- <small
                      id="emailError"
                      class="form-text text-muted"
                      v-if="sameEmail && $v.form.email.required && $v.form.email.email"
                      ><i class="fa fa-times"></i>&nbsp; Alamat email sudah terdaftar. Silakan gunakan alamat email lain</small
                    > -->
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="place_of_birth">Place of Birth</label>
                        <input
                          type="text"
                          class="form-control"
                          id="place_of_birth"
                          name="place_of_birth"
                          v-model="form.place_of_birth"
                          aria-describedby="place_of_birthError"
                          placeholder="Jakarta"
                        />
                        <small
                          id="place_of_birthError"
                          class="form-text text-muted"
                          v-if="submitted && !$v.form.place_of_birth.required"
                          ><i class="fa fa-info-circle text-xs"></i>&nbsp; Place of Birth is required</small
                        >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input
                          type="date"
                          class="form-control"
                          id="date_of_birth"
                          name="date_of_birth"
                          v-model="form.date_of_birth"
                          aria-describedby="date_of_birthError"
                          placeholder="Masukkan tanggal lahir"
                          v-on:change="checkSpecific()"
                        />
                        <small
                          id="date_of_birthError"
                          v-if="submitted && !$v.form.date_of_birth.required"
                          class="form-text text-muted"
                          ><i class="fa fa-info-circle text-xs"></i>&nbsp; Date of Birth is required</small
                        >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="gender">Gender</label>
                        <select
                          class="form-control"
                          id="gender"
                          v-model="form.gender"
                          aria-describedby="genderError"
                        >
                          <option value="" disabled>- - -</option>
                          <option value="L">Male</option>
                          <option value="P">Female</option>
                        </select>
                        <small
                          id="genderError"
                          class="form-text text-muted"
                          v-if="submitted && !$v.form.gender.required"
                          ><i class="fa fa-info-circle text-xs"></i>&nbsp; Please choose one</small
                        >
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <textarea
                      class="form-control"
                      id="address"
                      v-model="form.address"
                      rows="3"
                      aria-describedby="addresError"
                      placeholder="John Doe, 404 Ratan Icon Building, SEAWOODS 12345"
                    ></textarea>
                    <small
                      id="addresError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.address.required"
                      ><i class="fa fa-info-circle text-xs"></i>&nbsp; Address is required</small
                    >
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="upload_card">Account Image</label>
                        <input
                          type="file"
                          class="form-control-file"
                          id="upload_card"
                          ref="file1"
                          v-on:change.prevent="handleUploadCard()"
                        />
                        <small
                          id="addresError"
                          class="form-text text-muted"
                          v-if="submitted && !$v.form.upload_card.required"
                          ><i class="fa fa-info-circle text-xs"></i>&nbsp; ID Card is required</small
                        >
                        <small
                          id="addresError"
                          class="form-text text-muted"
                          v-if="$v.form.upload_card.required && wrongImage"
                          ><i class="fa fa-times text-xs"></i>&nbsp; File format is not supported</small
                        >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="password">Account Password</label>
                        <input
                          type="password"
                          class="form-control"
                          id="password"
                          name="password"
                          v-model="form.password"
                          aria-describedby="passwordError"
                          placeholder="Type new Password.."
                        />
                        <small
                          id="passwordError"
                          class="form-text text-muted"
                          v-if="submitted && !$v.form.password.required"
                          ><i class="fa fa-info-circle text-xs"></i>&nbsp; Password is required</small
                        >
                        <input
                          type="password"
                          class="form-control mt-3"
                          id="passwordRe"
                          name="passwordRe"
                          v-model="form.passwordRe"
                          aria-describedby="passwordReError"
                          placeholder="Re-Type new Password.."
                          v-on:change.prevent="checkNewPass()"
                        />
                        <small
                          id="passwordReError"
                          class="form-text text-muted"
                          v-if="submitted && !$v.form.passwordRe.required"
                          ><i class="fa fa-info-circle text-xs"></i>&nbsp; Password is required</small
                        >
                        <small
                          id="passwrodReError"
                          class="form-text text-muted"
                          v-if="$v.form.passwordRe.required && !samePassword"
                          ><i class="fa fa-times text-xs"></i>&nbsp; Password did not match. Please check again</small
                        >
                      </div>
                    </div>
                  </div>
                  <button
                    type="submit"
                    class="btn btn-primary float-right"
                    v-on:click.prevent="onRegister()"
                  >
                    Finish
                  </button>
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
import { required, minLength, email } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      form: {
        name: "",
        phone: "",
        email: "",
        place_of_birth: "",
        date_of_birth: "",
        gender: "",
        address: "",
        upload_card: "",
        password: "",
        passwordRe: "",
      },
      submitted: false,
      wrongImage: false,
      sameName: false,
      sameEmail: false,
      sameAll: false,
      samePassword: true,
      role: "",
    };
  },
  validations: {
    form: {
      name: { required },
      phone: { required, minLength: minLength(10) },
      email: { required, email },
      place_of_birth: { required },
      date_of_birth: { required },
      gender: { required },
      address: { required },
      upload_card: { required },
      password: { required },
      passwordRe: { required },
    },
  },
  computed: {
    departments() {},
    faculties() {},
    years() {},
  },
  mounted() {
    this.preAdmin();
  },
  methods: {
    capFLetter(string) {
      return string.replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase());
    },

    checkName() {
      if (this.form.name != "")
      {
        let formData = new FormData();
        formData.append("name", this.form.name);

        axios.post("/api/user/checkName", formData)
        .then((res) => {
          if(res.data.status == "Success")
            this.sameName = false;
          else
            this.sameName = true;
        })
        .catch((err) => {
          console.log(err);
        });
      }
      else
        this.sameName = false;
    },

    checkEmail() {
      if (this.form.email != "")
      {
        let formData = new FormData();
        formData.append("email", this.form.email);

        axios.post("/api/user/checkEmail", formData)
        .then((res) => {
          if(res.data.status == "Success")
            this.sameEmail = false;
          else
            this.sameEmail = true;
        })
        .catch((err) => {
          console.log(err);
        });
      }
      else
        this.sameEmail = false;
    },

    checkSpecific() {
      if (this.form.name != "" && 
          this.form.place_of_birth != "" && 
          this.form.date_of_birth != "" &&
          this.form.gender != "")
      {
        // console.log("All On")
        let formData = new FormData();
        formData.append("name", this.form.name);
        formData.append("place_of_birth", this.form.place_of_birth);
        formData.append("date_of_birth", this.form.date_of_birth);
        formData.append("gender", this.form.gender);

        axios.post("/api/user/checkSpecific", formData)
        .then((res) => {
          if(res.data.status == "Error")
          {
            this.sameAll = true;
            Vue.swal({
              icon: "warning",
              title: "User atas nama "+ this.capFLetter(this.form.name) + " telah terdaftar!",
              text: "Terdapat kesamaan antara data input dengan user yang telah terdaftar. Silakan cek data pada daftar user",
            });
          }
          else
            this.sameAll = false;
        })
        .catch((err) => {
          console.log(err);
        });
      }
    },

    handleUploadCard() {
      
      if (this.$refs.file1.files.length != 0)
      {
        this.form.upload_card = this.$refs.file1.files[0];
        var type = this.form.upload_card.type;

        if (type === 'image/jpeg' || type === 'image/png')
          this.wrongImage = false;
        else
          this.wrongImage = true;
      }
      else
      {
        this.wrongImage = false;
      }
      // console.log(this.form.upload_card == null);
    },

    preAdmin() {
      axios.get("/api/preAdmin")
      .then((res) => {
        // console.log(res.data.data);
        var count = res.data.data.data;

        if (count != 0) {
          this.$router.push("/");
        }
      });
    },

    checkNewPass() {
      if (this.form.password != "" && this.form.passwordRe != "")
      {
        if (this.form.password == this.form.passwordRe)
          this.samePassword = true;
        else
          this.samePassword = false;
      }
    },

    onRegister() {
      this.submitted = true;
      var vm = this;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }

      let formData = new FormData();
      formData.append("address", this.form.address);
      formData.append("date_of_birth", this.form.date_of_birth);
      formData.append("department", "0");
      formData.append("email", this.form.email);
      formData.append("faculty", "0");
      formData.append("gender", this.form.gender);
      formData.append("name", this.form.name);
      formData.append("phone", this.form.phone);
      // formData.append("photo", this.form.photo);
      formData.append("place_of_birth", this.form.place_of_birth);
      formData.append("upload_card", this.form.upload_card);
      formData.append("years", "0");
      formData.append("role", "Admin");
      formData.append("password", this.form.passwordRe);
      // formData.append("created_from", "Dashboard");

      if (this.samePassword)
      {
        axios
          .post("/api/registerAdmin", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((res) => {
            Vue.swal({
              icon: "success",
              title: "Successfuly Created!",
            });
            // console.log(res);
            vm.$router.push("/");
          })
          .catch(function() {
            Vue.swal({
              icon: "error",
              title: "Failed! Please try again",
            });

            console.log("FAILURE!!");
          });
      }
      else
      {
        Vue.swal({
          icon: "warning",
          title: "Password Did Not Match!",
          text: "Please check again your input password",
        });        
      }
      
    },
  },
};
</script>

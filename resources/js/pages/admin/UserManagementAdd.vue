<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Add New User</h1>
      <a
        @click="$router.go(-1)"
        class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
        ><i class="fas fa-arrow-left fa-sm text-white-50"></i>&nbsp; Return</a
      >
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div>
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
                    v-on:change="checkName(), checkSpecific()"
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
                    placeholder="6281100001234"
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
                    ><i class="fa fa-info-circle text-xs"></i>&nbsp; Phone number should not less than 10 digits</small
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
                    v-on:change="checkEmail()"
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
                  <small
                    id="emailError"
                    class="form-text text-muted"
                    v-if="sameEmail && $v.form.email.required && $v.form.email.email"
                    ><i class="fa fa-times"></i>&nbsp; Email has been registered, please use another email address</small
                  >
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
                        v-on:change="checkSpecific()"
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
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="department">Department</label>
                      <select
                        class="form-control"
                        id="department"
                        v-model="form.department"
                        aria-describedby="departmentError"
                      >
                        <option value="" disabled>- - -</option>
                        <option
                          v-for="(dept, d) in departments"
                          :key="d"
                          :value="dept.id"
                          >{{ dept.department_name }}</option
                        >
                      </select>
                      <small
                        id="departmentError"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.department.required"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp; Please choose one</small
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="faculty">Faculty</label>
                      <select
                        class="form-control"
                        id="faculty"
                        v-model="form.faculty"
                        aria-describedby="facultyError"
                      >
                        <option value="" disabled>- - -</option>
                        <option
                          v-for="(fac, f) in faculties"
                          :key="f"
                          :value="fac.id"
                          >{{ fac.faculty_name }}</option
                        >
                      </select>
                      <small
                        id="facultyError"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.faculty.required"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp; Please choose one</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="gender">Gender</label>
                      <select
                        class="form-control"
                        id="gender"
                        v-model="form.gender"
                        aria-describedby="genderError"
                        v-on:change="checkSpecific()"
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
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="year">Year</label>
                      <select
                        class="form-control"
                        id="year"
                        v-model="form.years"
                        aria-describedby="yearError"
                      >
                        <option value="" disabled>- - -</option>
                        <option
                          v-for="(year, y) in years"
                          :key="y"
                          :value="year.id"
                          >{{ year.year }}</option
                        >
                      </select>
                      <small
                        id="yearError"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.years.required"
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
                      <label for="upload_card">Upload ID Card</label>
                      <input
                        type="file"
                        class="form-control-file"
                        id="upload_card"
                        ref="file1"
                        v-on:change="handleUploadCard()"
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
                      <label for="year">Role</label>
                      <select
                        class="form-control"
                        id="year"
                        v-model="form.role"
                        aria-describedby="yearError"
                      >
                        <option value="" disabled>- - -</option>
                        <option value="Admin">Admin</option>
                        <option value="Editor">Editor</option>
                        <option value="User">User</option>
                      </select>
                      <small
                        id="yearError"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.role.required"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp; Please choose one</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-6 mt-2">
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" 
                          v-on:change="notify = !notify"
                          class="custom-control-input" 
                          id="customCheck" checked>
                        <label class="custom-control-label" for="customCheck">
                          Notify user by <b>Email</b> about Approval Status and Password. You can <b>uncheck this</b> 
                          if you want to make a custom password for this User
                        </label>
                      </div>
                      <hr style="border-top: 1px dashed #dadada;">
                    </div>
                    <div class="form-group" v-if="!notify">
                      <label for="password">Password</label>
                      <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        v-model="form.password"
                        aria-describedby="passwordError"
                        placeholder="Type password.."
                        v-on:change="noPass = false"
                      />
                      <small
                        id="passwordError"
                        class="form-text text-muted"
                        v-if="noPass"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp; Password is required</small
                      >

                      <input
                        type="password"
                        class="form-control mt-3"
                        id="passwordRe"
                        name="passwordRe"
                        v-model="form.passwordRe"
                        aria-describedby="passwordReError"
                        placeholder="Re-Type password.."
                        v-on:change="noPassRe = false"
                      />
                      <small
                        id="passwordReError"
                        class="form-text text-muted"
                        v-if="noPassRe"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp; Password is required</small
                      >
                      <small
                        id="passwordReError"
                        class="form-text text-muted"
                        v-if="form.passwordRe != form.password"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp; Password did not match</small
                      >
                    </div>
                  </div>
                </div>
                <button
                  type="submit"
                  class="btn btn-primary float-right"
                  v-on:click.prevent="onRegister()"
                >
                  Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .text-muted {
    color: red !important;
  }
  .text-muted-y {
    color: orange !important;
  }
</style>

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
        department: "",
        faculty: "",
        gender: "",
        address: "",
        years: "",
        role: "",
        upload_card: "",
        password: "",
        passwordRe: "",
        // photo: "",
      },
      submitted: false,
      wrongImage: false,
      sameName: false,
      sameEmail: false,
      sameAll: false,
      role: "",
      notify: true,
      noPass: false,
      noPassRe: false,
      noPassMatch: false,
    };
  },
  validations: {
    form: {
      name: { required },
      phone: { required, minLength: minLength(10) },
      email: { required, email },
      place_of_birth: { required },
      date_of_birth: { required },
      department: { required },
      faculty: { required },
      gender: { required },
      address: { required },
      years: { required },
      role: { required },
      upload_card: { required },
      // photo: { required },
    },
  },
  computed: {
    departments() {
      return this.$store.getters.getAllDepartments;
    },
    faculties() {
      return this.$store.getters.getAllFaculties;
    },
    years() {
      return this.$store.getters.getAllYears;
    },
  },
  mounted() {
    this.role = localStorage.getItem("role");
    if (localStorage.getItem("role") == "User") 
    {
      const vm = this;
      vm.$router.push("/my-upload");
    }

    this.$store.dispatch("getFaculties");
    this.$store.dispatch("getDepartments");
    this.$store.dispatch("getYears");
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
              title: "User named '"+ this.capFLetter(this.form.name) + "' has been registered!",
              text: "We detected data similarities between your input and a registered user.",
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

    onRegister() {
      this.submitted = true;
      var vm = this;
      this.$v.$touch();

      if (this.$v.$invalid) {
        return;
      }
      else if (!this.notify && this.form.password == undefined || !this.notify && this.form.password == '')
      {
        // console.log("noPass");
        this.noPass = true;
        return;
      }
      else if (!this.notify && this.form.passwordRe == undefined || !this.notify && this.form.passwordRe == '')
      {
        // console.log("noRePass");
        this.noPassRe = true;
        return;
      }

      let formData = new FormData();
      formData.append("address", this.form.address);
      formData.append("date_of_birth", this.form.date_of_birth);
      formData.append("department", this.form.department);
      formData.append("email", this.form.email);
      formData.append("faculty", this.form.faculty);
      formData.append("gender", this.form.gender);
      formData.append("name", this.form.name);
      formData.append("phone", this.form.phone);
      // formData.append("photo", this.form.photo);
      formData.append("place_of_birth", this.form.place_of_birth);
      formData.append("upload_card", this.form.upload_card);
      formData.append("years", this.form.years);
      formData.append("role", this.form.role);
      formData.append("created_from", "Dashboard");
      formData.append("password", this.form.password);
      formData.append("passwordRe", this.form.passwordRe);

      if (!this.sameAll)
      {
        axios
          .post("/api/register", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then(function() {
            Vue.swal({
              icon: "success",
              title: "Successfully Added!",
            });
            vm.$router.push("/user-management");
          })
          .catch(function() {
            console.log("FAILURE!!");
          });
      }
      else
      {
        Vue.swal({
          icon: "warning",
          title: "User named '"+ this.capFLetter(this.form.name) + "' has been registered!",
          text: "We detected data similarities between your input and a registered user.",
        });        
      }
      
    },
  },
};
</script>

<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Data Detail : {{ form.name }}
        <span class="badge badge-warning" v-if="form.approved == 0">
          Waiting
        </span>
        <span class="badge badge-success" v-if="form.approved == 1">
          Approved
        </span>
        <span class="badge badge-danger" v-if="form.approved == 2">
          Reject
        </span>
      </h1>
      <a
        @click="$router.go(-1)"
        class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
        ><i class="fas fa-arrow-left fa-sm text-white-50"></i>&nbsp; Return</a
      >
      <!-- <router-link
        :to="{ name: 'UserManagement' }"
        class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-arrow-left fa-sm text-white-50"></i>
        Kembali</router-link
      > -->
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body" v-if="loading">
            <div class="text-center">
              <loading-component></loading-component>
            </div>
          </div>
          <div class="card-body" v-if="!loading">
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
                  id="phoneError"
                  class="form-text text-muted"
                  v-if="submitted && !$v.form.name.required"
                  ><i class="fa fa-info-circle text-xs"></i>&nbsp; Name is required</small
                >
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input
                  type="text"
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
                    />
                    <small
                      id="place_of_birthError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.email.required"
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
                        :selected="dept.id === form.department"
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
                        :selected="fac.id === form.faculty"
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
                        :selected="year.id === form.years"
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
                      id="role"
                      v-model="form.role"
                      aria-describedby="yearError"
                    >
                      <option value="Admin" :selected="'Admin' === form.role">Admin</option>
                      <option value="Editor" :selected="'Editor' === form.role">Editor</option>
                      <option value="User" :selected="'User' === form.role">User</option>
                      <!-- <option
                        v-for="(year, y) in years"
                        :key="y"
                        :value="year.id"
                        :selected="year.id === form.years"
                        >{{ year.year }}</option
                      > -->
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

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <img
                      :src="
                        '/storage/uploads/upload_card/' + form.upload_card_name
                      "
                      alt="..."
                      class="img-fluid"
                      style="width: 40%"
                    />
                  </div>
                </div>
                <div class="col-md-6 mt-2">
                  <div class="form-group" v-if="form.approved == 0">
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
                  <div class="form-group" v-if="!notify || form.approved != 0">
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
                style="margin-left:10px"
                class="btn btn-success float-right"
                type="button"
                v-on:click.prevent="onUpdate()"
              >
                Update data
              </button>
              <div v-if="form.approved == 0">
                <button
                  type="submit"
                  style="margin-left:10px"
                  class="btn btn-primary float-right"
                  v-on:click.prevent="handleApproval(form.id, 1)"
                >
                  Approve
                </button>
                <button
                  type="submit"
                  class="btn btn-danger float-right"
                  v-on:click.prevent="handleReject(form.id, 2)"
                >
                  Reject
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { required, minLength, email } from "vuelidate/lib/validators";
export default {
  props: ["id"],
  data: function() {
    return {
      loading: true,
      form: {
        id: "",
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
        upload_card: "",
        approved: "",
        photo: "",
        upload_card_name: "",
        role: "",
        password: "",
        passwordRe: "",
      },
      submitted: false,
      faculties: [],
      departments: [],
      years: [],
      isDisabled: true,
      sameEmail: false,
      wrongImage: false,
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
      upload_card: { required },
      photo: { required },
      role: { required },
    },
  },
  watch: {
    $route(to, from) {
      this.getUser();
    },
  },
  mounted() {
    if (localStorage.getItem("role") == "User") 
    {
      const vm = this;
      vm.$router.push("/my-upload");
    }
    
    this.getUser();
    this.getFaculty();
    this.getDepartment();
    this.getYears();
  },
  computed: {
    rows() {
      return this.items.length;
    },
    users() {
      return this.$store.getters.getAllUsers;
    },
  },
  methods: {
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

    onUpdate() {
      // if (this.$v.$invalid)
      //   return;
      // else if (!this.notify && this.form.password == undefined || !this.notify && this.form.password == '')
      // {
      //   console.log("noPass");
      //   this.noPass = true;
      //   return;
      // }
      // else if (!this.notify && this.form.passwordRe == undefined || !this.notify && this.form.passwordRe == '')
      // {
      //   // console.log("noRePass");
      //   this.noPassRe = true;
      //   return;
      // }
      

      let formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("phone", this.form.phone);
      formData.append("email", this.form.email);
      formData.append("date_of_birth", this.form.date_of_birth);
      formData.append("place_of_birth", this.form.place_of_birth);
      formData.append("department", this.form.department);
      formData.append("faculty", this.form.faculty);
      formData.append("gender", this.form.gender);
      formData.append("year", this.form.years);
      formData.append("address", this.form.address);
      formData.append("upload_card", this.form.upload_card);
      formData.append("role", this.form.role);
      formData.append("password", this.form.password);
      formData.append("passwordRe", this.form.passwordRe);

      if (!this.wrongImage)
      {
        axios.post("/api/user/updateDataFull/" + this.id, formData)
        .then((res) => {
          console.log(res.data.data);
          Vue.swal({
            icon: "success",
            title: "Successfully Updated!",
          });

          this.notify = true;
          this.getUser();
        })
        .catch((error) => {
            console.log(error.response);
        });
      }
      else
      {
        Vue.swal({
          icon: "error",
          title: "File format is not supported!",
          text: "Please check again your uploaded file format",
        });
      }
      
    },

    handleReject(id, val) {
      Vue.swal({
        title: "Reject User",
        text: "Are you sure want to Reject this User?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "secondary",
        confirmButtonText: "Reject",
      }).then((result) => {
        if (result.isConfirmed) {
          this.handleApproval(id, val);
        }
      });
    },

    handleApproval(id, val) {
      // var vm = this;
      // if (this.$v.$invalid)
      //   return;
      // else if (!this.notify && this.form.password == undefined || !this.notify && this.form.password == '')
      // {
      //   // console.log("noPass");
      //   this.noPass = true;
      //   return;
      // }
      // else if (!this.notify && this.form.passwordRe == undefined || !this.notify && this.form.passwordRe == '')
      // {
      //   // console.log("noRePass");
      //   this.noPassRe = true;
      //   return;
      // }

      var data = { 
        approved: val, 
        password: this.form.password,
        passwordRe: this.form.passwordRe, 
      };

      axios.put("/api/user/verified/" + id, data)
      .then((res) => 
      {
        // console.log(res);
        var status = "Approve";
        
        if (val == 2)
          status = "Reject";

        Vue.swal({
          icon: "success",
          title: "User has been " + status,
        });

        vm.$router.push("/user-management");
      })
      .catch((err) => {
        console.log(err);
      });
    },

    getUser() {
      this.loading = true;
      axios.get("/api/user/" + this.id).then((res) => {
        // console.log(res.data.data.user.role);
        this.loading = false;
        this.form = {
          id: res.data.data.user.id,
          name: res.data.data.user.name,
          phone: res.data.data.user.phone,
          email: res.data.data.user.email,
          place_of_birth: res.data.data.user.place_of_birth,
          date_of_birth: res.data.data.user.date_of_birth,
          department: res.data.data.user.department,
          faculty: res.data.data.user.faculty,
          gender: res.data.data.user.gender,
          address: res.data.data.user.address,
          years: res.data.data.user.years,
          upload_card: res.data.data.user.upload_card,
          photo: res.data.data.user.photo,
          approved: res.data.data.user.approved,
          upload_card_name: res.data.data.user.upload_card_name,
          role: res.data.data.user.role,
        };
      });
    },

    getFaculty() {
      axios.get("/api/faculty").then((res) => {
        this.faculties = res.data.data.Faculty;
        // console.log(res);
        // console.log(this.faculties);
      });
    },

    getDepartment() {
      axios.get("/api/department").then((res) => {
        this.departments = res.data.data.department;
        // console.log(res);
        // console.log(this.departments);
      });
    },

    getYears() {
      axios.get("/api/year").then((res) => {
        this.years = res.data.data.year;
        // console.log(res);
        // console.log(this.years);
      });
    },
  },
};
</script>

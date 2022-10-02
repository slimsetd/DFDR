<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a
      > -->
    </div>
    <div class="container">
      <div class="main-body">

        <div class="row gutters-sm">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img
                    :src="
                      '/storage/uploads/upload_card/' + profile.upload_card_name
                    "
                    alt="Admin"
                    class="img img-thumbnail"
                    width="150"
                  />
                  <div class="mt-3">
                    <h4><b>{{ this.profile.name }}</b></h4>
                    <p class="text-secondary mb-1">{{ this.profile.role }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row" style="margin-bottom: 40px; margin-top: 10px;">
                  <div class="col-sm-4">
                    <h4>User Data</h4>
                  </div>
                  <div class="col-sm-8">
                    <button
                      type="button"
                      class="btn btn-primary float-right"
                      v-if="!onEdit"
                      v-on:click.prevent="onEdit = !onEdit"
                    >
                      Edit
                    </button>

                    <div class="float-right">
                      <button
                        type="button"
                        class="btn btn-success"
                        v-if="onEdit"
                        v-on:click.prevent="onUpdate()"
                      >
                        Update
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary"
                        v-if="onEdit"
                        v-on:click.prevent="onCancel()"
                      >
                        Cancel
                      </button>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">&nbsp; Nama Lengkap</h6>
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="!onEdit">
                    &nbsp; : &nbsp; <b>{{ this.profile.name }}</b>
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="onEdit">
                    <input
                      type="text"
                      class="form-control"
                      id="title"
                      v-model="form.name"
                      required
                      aria-describedby="nameError"
                      placeholder="Cth : Budi Gunawan"
                    />
                    <small
                      id="nameError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.name.required"
                      >Nama tidak boleh kosong</small
                    >
                  </div>
                </div>
                <hr style="margin-top: 10px;" />
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">&nbsp; Email</h6>
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="!onEdit">
                    &nbsp; : &nbsp; <b>{{ this.profile.email }}</b>
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="onEdit">
                    <input
                      type="text"
                      class="form-control"
                      id="title"
                      v-model="form.email"
                      required
                      aria-describedby="emailError"
                      placeholder="Cth : Sample@mail.com"
                      v-on:change="checkEmail()"
                    />
                    <small
                      id="emailError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.email.required"
                      >Alamat Email tidak boleh kosong</small
                    >
                    <small
                      id="emailError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.email.required && !$v.form.email.email"
                      >Alamat email tidak valid</small
                    >
                    <small
                      id="emailError"
                      class="form-text text-muted"
                      v-if="sameEmail"
                      ><i class="fa fa-times"></i>&nbsp; Alamat email sudah terdaftar. Silakan gunakan alamat email lain</small
                    >
                  </div>
                </div>
                <hr style="margin-top: 10px;" />
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">&nbsp; No. Handphone</h6>
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="!onEdit">
                    &nbsp; : &nbsp; <b>{{ this.profile.phone }}</b>
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="onEdit">
                    <input
                      type="number"
                      class="form-control"
                      id="title"
                      v-model="form.phone"
                      required
                      aria-describedby="phoneError"
                      placeholder="Cth : 081100001234"
                    />
                    <small
                      id="phoneError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.phone.required"
                      >No. Handphone tidak boleh kosong</small
                    >
                  </div>
                </div>
                <hr style="margin-top: 10px;" />
                <!-- <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Tanggal Lahir</h6>
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="!onEdit">
                    {{ this.profile.date_of_birth }}
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="onEdit">
                    <input
                      type="date"
                      class="form-control"
                      v-model="form.date_of_birth"
                      required
                      aria-describedby="dateError"
                    />
                    <small
                      id="dateError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.date_of_birth.required"
                      >Tanggal Lahir tidak boleh kosong</small
                    >
                  </div>
                </div>
                <hr /> -->
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">&nbsp; Alamat</h6>
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="!onEdit">
                    &nbsp; : &nbsp; <b>{{ this.profile.address }}</b>
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="onEdit">
                    <textarea
                      class="form-control"
                      v-model="form.address"
                      rows="3"
                      aria-describedby="addresError"
                      placeholder="Cth : Jl.Lorem Ipsum No.10 Abc, Bogor, Jawa Barat"
                    ></textarea>
                    <small
                      id="addressError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.address.required"
                      >Alamat tidak boleh kosong</small
                    >
                  </div>
                </div>
                <hr style="margin-top: 10px;" v-if="onEdit"/>
                <div class="row">
                  <div class="col-sm-3" v-if="onEdit">
                    <h6 class="mb-0">&nbsp; Upload Card</h6>
                  </div>
                  <div class="col-sm-9 text-secondary" v-if="onEdit">
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
                      >Format gambar tidak didukung</small
                    >
                  </div>
                </div>
                <br>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <div class="row" style="margin-bottom: 10px; margin-top: 10px;">
                  <div class="col-sm-4">
                    <h4>Ubah Password</h4>
                  </div>
                  <div class="col-sm-8">
                    <div class="float-right">
                      <button
                        type="button"
                        class="btn btn-primary float-right"
                        v-if="!onEditPass"
                        v-on:click.prevent="onEditPass = !onEditPass"
                      >
                        Edit
                      </button>

                      <button
                        type="button"
                        class="btn btn-success"
                        v-if="onEditPass"
                        v-on:click.prevent="onUpdatePass()"
                      >
                        Update
                      </button>
                      <button
                        type="button"
                        class="btn btn-secondary"
                        v-if="onEditPass"
                        v-on:click.prevent="onCancelPass()"
                      >
                        Cancel
                      </button>
                    </div>
                  </div>
                </div>

                <div v-if="onEditPass" style="margin-top: 40px;">

                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">&nbsp; Password Lama</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input
                      type="password"
                      class="form-control"
                      id="title"
                      v-model="form.oldPass"
                      required
                      aria-describedby="passError"
                      placeholder="Ketik password lama .."
                      v-on:change.prevent="checkPass()"
                    />
                    <small
                      id="passError"
                      class="form-text text-muted"
                      v-if="subPass && !$v.form.oldPass.required"
                      >*Field tidak boleh kosong</small
                    >
                    <small
                      id="passError"
                      class="form-text text-muted"
                      v-if="samePass == 2 && $v.form.oldPass.required"
                      ><i class="fa fa-times"></i>&nbsp; Password Lama tidak sesuai. Silakan periksa kembali</small
                    >
                    <small
                      id="passError"
                      class="form-text text-muted-g"
                      v-if="samePass == 1 && $v.form.oldPass.required"
                      ><i class="fa fa-check"></i>&nbsp; Password Lama terkonfirmasi</small
                    >
                  </div>
                </div>
                <hr style="margin-top: 10px;" />
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">&nbsp; Password Baru</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input
                      type="password"
                      class="form-control"
                      v-model="form.newPass"
                      required
                      aria-describedby="newpassError"
                      placeholder="Ketik password baru .."
                      v-on:change.prevent="checkNewPass()"
                    />
                    <small
                      id="newpassError"
                      class="form-text text-muted"
                      v-if="subPass && !$v.form.newPass.required"
                      >*Field tidak boleh kosong</small
                    >
                    <small
                      id="newpassError"
                      class="form-text text-muted-y"
                      v-if="!$v.form.newPass.minLength"
                      ><i class="fa fa-lock text-xs"></i>&nbsp; Password tidak boleh kurang dari 10 character</small
                    >
                  </div>
                </div>
                <div class="row" style="margin-top: 13px;">
                  <div class="col-sm-3">
                    
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input
                      type="password"
                      class="form-control"
                      id="title"
                      v-model="form.reNewPass"
                      required
                      aria-describedby="renewpassError"
                      placeholder="Ketik ulang password baru .."
                      v-on:change.prevent="checkNewPass()"
                    />
                    <small
                      id="renewpassError"
                      class="form-text text-muted"
                      v-if="subPass && !$v.form.reNewPass.required"
                      >*Field tidak boleh kosong</small
                    >
                    <small
                      id="renewpassError"
                      class="form-text text-muted-y"
                      v-if="$v.form.reNewPass.required && !$v.form.newPass.minLength"
                      ><i class="fa fa-lock text-xs"></i>&nbsp; Password tidak boleh kurang dari 10 character</small
                    >
                    <small
                      id="renewpassError"
                      class="form-text text-muted-g"
                      v-if="$v.form.reNewPass.required && $v.form.newPass.minLength && sameNewPass == 1"
                      ><i class="fa fa-check"></i>&nbsp; Password Baru terkonfirmasi</small
                    >
                    <small
                      id="renewpassError"
                      class="form-text text-muted"
                      v-if="$v.form.reNewPass.required && sameNewPass == 2"
                      ><i class="fa fa-times"></i>&nbsp; Password Baru tidak sesuai. Silakan periksa kembali</small
                    >
                  </div>
                </div>
                <br>

                </div>

              </div>
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
  .text-muted-g {
    color: rgb(0, 165, 0) !important;
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
      profile: {},
      loading: true,
      id: localStorage.getItem("user_id"),
      onEdit: false,
      onEditPass: false,
      submitted: false,
      sameEmail: false,
      subPass: false,
      samePass: 0,
      sameNewPass: 0,
      onDisabled: true,
      wrongImage: false,
      form: {
        name: "",
        email: "",
        phone: "",
        date_of_birth: "",
        address: "",
        upload_card: "",
      },
    };
  },
  validations: {
    form: {
      name: { required },
      email: { required, email },
      phone: { required },
      address: { required },
      oldPass: { required },
      newPass: { required, minLength: minLength(10) },
      reNewPass: { required },
      upload_card: { required },
    },
  },
  mounted() {
    this.getProfileUser();
  },

  methods: {
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

    onCancel() {
      this.onEdit = !this.onEdit;
      this.form.name = this.profile.name;
      this.form.email = this.profile.email;
      this.form.phone = this.profile.phone;
      this.form.address = this.profile.address;
      this.sameEmail = false;
    },

    onCancelPass() {
      // this.onEditPass = !this.onEditPass;
      // this.onDisabled = !this.onDisabled;
      this.form.oldPass = "";
      this.form.newPass = "";
      this.form.reNewPass = "";
      this.samePass = 0;
      this.sameNewPass = 0;
      this.subPass = false;
      // this.form.newPass.minLength = 10;
      this.onEditPass = false;
    },

    getProfileUser() {
      axios.get("/api/user/" + this.id).then((res) => {
        this.profile = res.data.data.user;
        this.form.name = this.profile.name;
        this.form.email = this.profile.email;
        this.form.phone = this.profile.phone;
        this.form.address = this.profile.address;

        // console.log(res.data.data);
        // console.log();
      });
    },

    checkEmail() {
      if (this.form.email != "")
      {
        if (this.form.email != this.profile.email)
        {
          let formData = new FormData();
          formData.append("email", this.form.email);

          axios.post("/api/user/checkEmail", formData)
          .then((res) => {
            // console.log(res.data);
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
      }
      else
        this.sameEmail = false;
    },

    checkPass() {
      if (this.form.oldPass != "")
      {
        let formData = new FormData();
        formData.append("password", this.form.oldPass);

        axios.post("/api/user/checkPass/" + this.id, formData)
        .then((res) => {
          // console.log(res.data);
          if(res.data.status == "Success")
            this.samePass = 1;
          else
            this.samePass = 2;
        })
        .catch((err) => {
          console.log(err);
        });
      }
      else
        this.samePass = 0;
    },

    checkNewPass() {
      this.subPass = false;

      // console.log(this.$v.form.newPass.minLength);

      if (this.$v.form.newPass.minLength)
      {
        if (this.form.newPass != "" && this.form.reNewPass != "")
        {
          if (this.form.newPass == this.form.reNewPass)
            this.sameNewPass = 1;
          else
            this.sameNewPass = 2;
        }
      }
      else
        this.sameNewPass = 0;
    },

    onUpdate() {
      this.submitted = true;
      
      // this.$v.$touch();
      // if (this.$v.$invalid) {
      //   return;
      // }

      if (!this.sameEmail) {
        let formData = new FormData();
        formData.append("name", this.form.name);
        formData.append("email", this.form.email);
        formData.append("phone", this.form.phone);
        formData.append("address", this.form.address);
        formData.append("upload_card", this.form.upload_card);

        axios
          .post("/api/user/updateData/" + this.profile.id, formData)
          .then((res) => {
            // this.resetData();
            Vue.swal({
              icon: "success",
              title: "Berhasil diubah!",
            });
            // console.log(res);

            this.getProfileUser();
            this.onEdit = false;
          })
          .catch((err) => {
            console.log(err);
          });
      }
      // else
      //   return;
    },

    onUpdatePass() {
      
      this.subPass = true;

      // this.$v.$touch();
      // if (this.$v.$invalid) {
      //   return;
      // }

      if (this.samePass != 1 || this.sameNewPass != 1 || !this.$v.form.newPass.minLength) {
        // console.log("test");
        return;
      }
      else
      {
        // console.log("safe");

        let formData = new FormData();
        formData.append("password", this.form.oldPass);
        formData.append("newPass", this.form.reNewPass);

        axios
          .post("/api/user/changePass/" + this.id, formData)
          .then((res) => {
            // console.log(res);

            Vue.swal({
              icon: "success",
              title: "Berhasil diubah!",
            });

            this.getProfileUser();
            this.onCancelPass();
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
  },
};
</script>

<style>
.main-body {
  padding: 15px;
}
.card {
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 0 solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
}

.card-body {
  flex: 1 1 auto;
  min-height: 1px;
  padding: 1rem;
}

.gutters-sm {
  margin-right: -8px;
  margin-left: -8px;
}

.gutters-sm > .col,
.gutters-sm > [class*="col-"] {
  padding-right: 8px;
  padding-left: 8px;
}
.mb-3,
.my-3 {
  margin-bottom: 1rem !important;
}

.bg-gray-300 {
  background-color: #e2e8f0;
}
.h-100 {
  height: 100% !important;
}
.shadow-none {
  box-shadow: none !important;
}
</style>

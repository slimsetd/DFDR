<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Master Subject</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a
      > -->
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <b-row class="mb-3">
              <b-col md="3">
                <b-form-input
                  v-model="filter"
                  type="search"
                  id="filterInput"
                  placeholder="Type to Search"
                ></b-form-input>
              </b-col>

              <b-col>

                   <b-button
                variant="success"
                class="btn-sm float-right ml-1"
                v-b-tooltip.hover
                title="Export as Excel"
                v-on:click.prevent="downloadExcel()"
                ><i class="fas fa-fw fa-file-excel"></i
              ></b-button>
              </b-col>
            </b-row>
            <b-table
              hover
              responsive
              :items="items"
              :fields="fields"
              :per-page="perPage"
              :current-page="currentPage"
              :filter="filter"
            >
              <template v-slot:cell(actions)="data">
                <b-button
                  v-b-modal.modal-1
                  variant="success"
                  class="btn-sm"
                  v-b-tooltip.hover
                  title="Detail"
                  v-on:click="toDetail(data.item.id)"
                  ><i class="fas fa-fw fa-edit"></i
                ></b-button>
                <b-button
                  variant="danger"
                  class="btn-sm"
                  v-b-tooltip.hover
                  title="Delete"
                  @click="toDelete(data.item.id)"
                  ><i class="fas fa-fw fa-trash-alt"></i
                ></b-button>
              </template>
            </b-table>
            <b-pagination
              pills
              v-model="currentPage"
              :total-rows="rows"
              :per-page="perPage"
              aria-controls="my-table"
              change="handlePaging($event)"
            ></b-pagination>
            <ul style="display: hidden">
              <li v-for="(cat, c) in subject" :key="c">
                {{ cat.subject_name }}
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4>Form Subject</h4>
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="subjectError"
                  placeholder="Input Subject.."
                  v-model="form.subject_name"
                />
                <small
                  id="subjectError"
                  class="form-text text-muted"
                  v-if="submittedForm && !$v.form.subject_name.required"
                  ><i class="fa fa-info-circle text-xs"></i>&nbsp; Subject name
                  is required</small
                >
              </div>
              <button
                type="submit"
                class="btn btn-sm btn-primary"
                v-if="updated == false"
                v-on:click.prevent="handleCreatedDegree()"
              >
                Submit
              </button>
              <button
                type="submit"
                class="btn btn-sm btn-success"
                v-if="updated == true"
                v-on:click.prevent="handleUpdatedDegree()"
              >
                Update
              </button>
              <button
                type="submit"
                class="btn btn-sm btn-secondary"
                v-if="updated == true"
                v-on:click.prevent="clearData()"
              >
                Cancel
              </button>

              <input
                type="file"
                class="float-right form-control mt-2"
                id="upload_card"
                ref="file1"
                aria-describedby="fileError"
                v-on:change="handleUploadCard()"
              />

              <button
                type="submit"
                class="btn btn-sm btn-primary float-right mr-1 mt-2"
                v-on:click.prevent="onRegister()"
              >
                <i class="fas fa-upload fa-sm text-white-50"></i>&nbsp; Import
              </button>
              <small
                id="fileError"
                class="form-text text-muted"
                v-if="submitted && !$v.form.fileExcel.required"
                >Harap upload excel file</small
              >
              <small
                id="fileError"
                class="form-text text-muted"
                v-if="$v.form.fileExcel.required && wrongFormat & !submitted"
                ><i class="fa fa-times"></i>&nbsp; Format file tidak
                didukung</small
              >
            </form>
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
</style>

<script>
import { required, minLength, email } from "vuelidate/lib/validators";
export default {
  data() {
    return {
      id: "",
      filter: "",
      perPage: 10,
      currentPage: 1,
      fields: ["subject_name", "actions"],
      items: [],
      form: {
        subject_name: "",
      },
      form: {
        fileExcel: "",
      },
      isGenerated: false,
      linkDownload: "",
      submitted: false,
      submittedForm: false,
      wrongFormat: false,

      submitted: false,
      updated: false,
    };
  },
  validations: {
    form: {
      subject_name: { required },
      fileExcel: { required },
    },
  },
  computed: {
    subject() {
      this.items = this.$store.getters.getAllSubject;
    },
    rows() {
      return this.items.length;
    },
  },
  mounted() {
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }
    this.$store.dispatch("getSubject");
  },
  methods: {
    downloadExcel(){
      axios.get(`/api/excel/export/subject`, 
       {responseType: 'arraybuffer'}).then(response => {
          var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');
        fileLink.href = fileURL;
        fileLink.setAttribute('download', 'subject.xlsx');
       document.body.appendChild(fileLink);
       fileLink.click();
       fileLink.close();
      });
    },
    onRegister() {
      console.log('executedd');
      this.submitted = true;
      var vm = this;
      // this.$v.$touch();
      // if (this.$v.$invalid) {
      //   return;
      // }
      let formData = new FormData();
      formData.append("file", this.form.fileExcel);
      axios
        .post("/api/excel/import/subject", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(function() {
          Vue.swal({
            icon: "success",
            title: "Bulk excel Berhasil!",
          });
          // this.$store.dispatch("getUploadedFile");

          // vm.$store.dispatch("getUploadedFile");
          // vm.$router.push("/editor-management");
          // this.clearData();
            vm.$store.dispatch("getSubject");
          // console.log("SUCCESS!!");
        })
        .catch(function(error) {
          Vue.swal({
            icon: "error",
            title: "Import excel Gagal!",
            text:
              "Mohon perhatikan kembali format excel atau jumlah data input harus lebih dari 5 data",
          });
          console.log(error);
        });
    },
    handleUploadCard() {
      if (this.$refs.file1.files.length != 0) {
        this.form.fileExcel = this.$refs.file1.files[0];
        var type = this.form.fileExcel.type;

        if (
          type ===
          "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        )
          this.wrongFormat = false;
        else this.wrongFormat = true;
      } else {
        this.wrongFormat = false;
      }
    },
    handleCreatedDegree() {
      this.submittedForm = true;
      var vm = this;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      // console.log(this.form);
      let formData = new FormData();
      formData.append("subject_name", this.form.subject_name);
      axios.post("/api/subject", formData).then((res) => {
        // console.log(res.data);
        if (res.data.status == "Success") {
          Vue.swal({
            icon: "success",
            title: "Successfully Added!",
          });
        } else {
          Vue.swal({
            icon: "error",
            title: "Failed to Add!",
            text: "Data with same name already exist",
          });
        }

        this.$store.dispatch("getSubject");
        this.clearData();
      });
    },

    toDelete(id) {
      // console.log("delete" + id);
      Vue.swal({
        title: "Delete Data",
        text: "Are you sure want to delete this data permanently?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "secondary",
        confirmButtonText: "Delete",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete("/api/subject/" + id).then((res) => {
            Vue.swal({
              icon: "success",
              title: "Successfully Deleted!",
            });
            this.$store.dispatch("getSubject");
          });
        }
      });
    },

    toDetail(id) {
      this.updated = true;
      axios.get("/api/subject/" + id).then((res) => {
        this.form.subject_name = res.data.data.subject.subject_name;
        this.id = res.data.data.subject.id;
        // console.log(this.id);
      });
    },

    handleUpdatedDegree() {
      var vm = this;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      let formData = new FormData();
      formData.append("subject_name", this.form.degree_name);
      axios.put("/api/subject/" + this.id, this.form).then((res) => {
        // console.log(res);
        if (res.data.status == "Success") {
          Vue.swal({
            icon: "success",
            title: "Successfully Updated!",
          });
        } else {
          Vue.swal({
            icon: "error",
            title: "Failed to Update!",
            text: "Data with same name already exist",
          });
        }

        this.clearData();
        this.$store.dispatch("getSubject");
      });
    },

    clearData() {
      this.submittedForm = false;
      this.updated = false;
      this.form.subject_name = "";
      this.id = "";
    },
  },
};
</script>

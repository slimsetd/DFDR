<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Export & Import Editors</h1>
      <button
        type="button"
        class="btn btn-success btn-sm shadow-sm"
        v-on:click.prevent="exportTemplate()"
      >
        <i class="fas fa-download fa-sm text-white-50"></i>&nbsp; Download Template
      </button>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="upload_card">Import Excel File</label>
                <input
                  type="file"
                  class="form-control-file"
                  id="upload_card"
                  ref="file1"
                  aria-describedby="fileError"
                  v-on:change="handleUploadCard()"
                />
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
                  ><i class="fa fa-times"></i>&nbsp; Format file tidak didukung</small
                >
              </div>
              
              <button
                v-on:click.prevent="exportUser()"
                class=" btn btn-sm btn-secondary shadow-sm float-right ml-1"
              >
                <i class="fas fa-download fa-sm text-white-50"></i>&nbsp; Export Editor Data
              </button>
              <button
                type="submit"
                class="btn btn-sm btn-primary float-right"
                v-on:click.prevent="onRegister()"
              >
                <i class="fas fa-upload fa-sm text-white-50"></i>&nbsp; Import
              </button>
              
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
      form: {
        fileExcel: "",
      },
      isGenerated: false,
      linkDownload: "",
      submitted: false,
      wrongFormat: false,
    };
  },
  validations: {
    form: {
      fileExcel: { required },
    },
  },
  computed: {},
  mounted() {
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }
    // this.$store.dispatch("getCategory");
  },
  methods: {
    handleUploadCard() {
      // this.form.fileExcel = this.$refs.file1.files[0];
      // console.log();

      if (this.$refs.file1.files.length != 0)
      {
        this.form.fileExcel = this.$refs.file1.files[0];
        var type = this.form.fileExcel.type;

        if (type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
          this.wrongFormat = false;
        else
          this.wrongFormat = true;
      }
      else
      {
        this.wrongFormat = false;
      }
        
    },

    excelExport2() {
      let linkName = "/download/release/";
      axios.get("/api/user/export-excel").then((res) => {
        this.isGenerated = true;
        console.log(res);
        this.linkDownload = linkName + res.data.data.excel;
        console.log(this.isGenerated);
      });
    },

    exportUser() {
      axios.get("/api/user/export-editor-excel").then((res) => {
        if (res) {
          var file_path = "/downloads/release/" + res.data.data.excel;
          var a = document.createElement("A");
          a.href = file_path;
          a.download = file_path.substr(file_path.lastIndexOf("/") + 1);
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a);
        }
      });
    },

    exportTemplate() {
      // axios.get("/api/user/export-template-excel").then((res) => {
      //   if (res) {
          var file_path = "/downloads/release/template_editor.xlsx";
          var a = document.createElement("A");
          a.href = file_path;
          a.download = file_path.substr(file_path.lastIndexOf("/") + 1);
          document.body.appendChild(a);
          a.click();
          // window.open(file_path);
          document.body.removeChild(a);
      //   }
      // });
    },

    onRegister() {
      this.submitted = true;
      var vm = this;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      let formData = new FormData();
      formData.append("file", this.form.fileExcel);
      axios
        .post("/api/user/importEditor", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(function() {
          Vue.swal({
            icon: "success",
            title: "Bulk excel Berhasil!",
          });
          vm.$router.push("/editor-management");
          // this.clearData();
          console.log("SUCCESS!!");
        })
        .catch(function(error) {
          Vue.swal({
            icon: "error",
            title: "Import excel Gagal!",
            text: "Mohon perhatikan kembali format excel atau jumlah data input harus lebih dari 5 data",
          });
          console.log(error);
        });
    },

    clearData() {
      this.$refs.file1.value = null;
    },
  },
};
</script>

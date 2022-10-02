<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Master Department</h1>
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
                  class="btn-sm"
                  variant="success"
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
              <li v-for="(cat, c) in departments" :key="c">
                {{ cat.department_name }}
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4>Form Department</h4>
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="nameError"
                  placeholder="Input Department.."
                  v-model="form.department_name"
                />
                <small
                  id="nameError"
                  class="form-text text-muted"
                  v-if="submitted && !$v.form.department_name.required"
                  ><i class="fa fa-info-circle text-xs"></i>&nbsp; Department name is required</small
                >
              </div>
              <button
                type="submit"
                class="btn btn-sm btn-primary"
                v-if="updated == false"
                v-on:click.prevent="handleCreatedDepartment()"
              >
                Submit
              </button>
              <button
                type="submit"
                class="btn btn-sm btn-success"
                v-if="updated == true"
                v-on:click.prevent="handleUpdatedDepartment()"
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
      fields: ["department_name", "actions"],
      items: [],
      form: {
        department_name: "",
      },
      submitted: false,
      updated: false,
    };
  },
  validations: {
    form: {
      department_name: { required },
    },
  },
  computed: {
    rows() {
      return this.items.length;
    },
    departments() {
      this.items = this.$store.getters.getAllDepartments;
    },
  },
  mounted() {
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }
    this.$store.dispatch("getDepartments");
  },
  methods: {
    onRegister(){},
    handleUploadCard(){},
    handleCreatedDepartment() {
      this.submitted = true;
      var vm = this;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      // console.log(this.form);
      let formData = new FormData();
      formData.append("department_name", this.form.department_name);
      axios.post("/api/department", formData).then((res) => 
      {
        // console.log(res.data);
        if(res.data.status == "Success")
        {
          Vue.swal({
            icon: "success",
            title: "Successfully Added!",
          });
        }
        else
        {
          Vue.swal({
            icon: "error",
            title: "Failed to Add!",
            text: "Data with same name already exist",
          });
        }

        this.$store.dispatch("getDepartments");
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
          axios.delete("/api/department/" + id).then((res) => {
            Vue.swal({
              icon: "success",
              title: "Successfully Deleted!",
            });
            this.$store.dispatch("getDepartments");
          });
        }
      });
    },

    toDetail(id) {
      this.updated = true;
      axios.get("/api/department/" + id).then((res) => {
        this.form.department_name = res.data.data.department.department_name;
        this.id = res.data.data.department.id;
        // console.log(this.id);
      });
    },

    handleUpdatedDepartment() {
      var vm = this;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      axios.put("/api/department/" + this.id, this.form).then((res) => 
      {
        // console.log(res);
        if(res.data.status == "Success")
        {
          Vue.swal({
            icon: "success",
            title: "Successfully Updated!",
          });
        }
        else
        {
          Vue.swal({
            icon: "error",
            title: "Failed to Update!",
            text: "Data with same name already exist",
          });
        }
        
        this.clearData();
        this.$store.dispatch("getDepartments");
      });
    },

    clearData() {
      this.submitted = false;
      this.updated = false;
      this.form.department_name = "";
      this.id = "";
    },
  },
};
</script>

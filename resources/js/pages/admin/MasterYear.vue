<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Master Year</h1>
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
              <li v-for="(cat, c) in years" :key="c">
                {{ cat.year }}
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4>Form Year</h4>
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <input
                  type="number"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="nameError"
                  placeholder="Input Year.."
                  v-model="form.year"
                />
                <small
                  id="nameError"
                  class="form-text text-muted"
                  v-if="submitted && !$v.form.year.required"
                  ><i class="fa fa-info-circle text-xs"></i>&nbsp; Year is required</small
                >
              </div>
              <button
                type="submit"
                class="btn btn-sm btn-primary"
                v-if="updated == false"
                v-on:click.prevent="handleCreatedYear()"
              >
                Submit
              </button>
              <button
                type="submit"
                class="btn btn-sm btn-success"
                v-if="updated == true"
                v-on:click.prevent="handleUpdatedYear()"
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
      fields: ["year", "actions"],
      items: [],
      form: {
        year: "",
      },
      submitted: false,
      updated: false,
    };
  },
  validations: {
    form: {
      year: { required },
    },
  },
  computed: {
    rows() {
      return this.items.length;
    },
    years() {
      this.items = this.$store.getters.getAllYears;
    },
  },
  mounted() {
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }
    this.$store.dispatch("getYears");
  },
  methods: {
    handleCreatedYear() {
      this.submitted = true;
      var vm = this;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      // console.log(this.form);
      let formData = new FormData();
      formData.append("year", this.form.year);
      axios.post("/api/year", formData).then((res) => 
      {
        // console.log(res);
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

        this.$store.dispatch("getYears");
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
          axios.delete("/api/year/" + id).then((res) => {
            Vue.swal({
              icon: "success",
              title: "Successfully Deleted!",
            });
            this.$store.dispatch("getYears");
          });
        }
      });
    },

    toDetail(id) {
      this.updated = true;
      axios.get("/api/year/" + id).then((res) => {
        this.form.year = res.data.data.year.year;
        this.id = res.data.data.year.id;
        // console.log(this.id);
      });
    },

    handleUpdatedYear() {
      var vm = this;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      let formData = new FormData();
      formData.append("year", this.form.year);
      axios.put("/api/year/" + this.id, this.form).then((res) => {
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
        this.$store.dispatch("getYears");
      });
    },

    clearData() {
      this.submitted = false;
      this.updated = false;
      this.form.year = "";
      this.id = "";
    },
  },
};
</script>

<template>
  <div>
    <h3>Report All Deposit</h3>
    <div class="card mb-3">
      <div class="card-body m-3">
        <form>
          <div class="row">
            <div class="col-md-6">
    <div class="mt-2 mb-2">
      <p>Report name</p>
     <input
                            format="text"
                            class="form-control"
                            v-model="report_name"
                            placeholder="Enter name.."
                          
                          />
    </div>
              <div class="form-group">
                <label for="">Filter By</label>
                <select
                  class="form-control"
                  id="filter"
                  v-model="form.filter"
                  aria-describedby="filterError"
                  v-on:change.prevent="onFilterChange()"
                >
                  <option value="" selected>None (All Deposits)</option>
                  <option value="date_range">Date Range</option>
                  <option value="this_month">This Month</option>
                  <option value="category">Category</option>
                  <option value="division">Division</option>
                  <!-- <option value="users_contribution">Users Contribution</option> -->
                </select>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Sort By</label>
                <select
                  class="form-control"
                  id="sort"
                  v-model="form.sort"
                  aria-describedby="sortError"
                >
                  <option value="" selected>ID</option>
                  <option value="title">Title</option>
                  <option value="category">Category</option>
                  <option value="date">Date</option>
                  <option value="status">Status</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div v-if="fil_date">
                <div class="form-group">
                  <label for="">Tanggal Awal &nbsp;-&nbsp; Tanggal Akhir</label>
                  <input
                    type="date"
                    name="start_date"
                    class="form-control"
                    aria-describedby="start_dateError"
                    v-model="form.start_date"
                  />
                  <!-- <small
                    id="start_dateError"
                    class="form-text text-muted"
                    v-if="submitted && !$v.form.start_date.required"
                    >Tanggal Awal tidak boleh kosong</small
                  > -->
                </div>
                <div class="form-group">
                  <input
                    type="date"
                    name="end_date"
                    class="form-control"
                    aria-describedby="end_dateError"
                    v-model="form.end_date"
                  />
                  <!-- <small
                    id="end_dateError"
                    class="form-text text-muted"
                    v-if="submitted && !$v.form.end_date.required"
                    >Tanggal Akhir tidak boleh kosong</small
                  > -->
                </div>
              </div>
              <div class="form-group" v-if="fil_category">
                <!-- <label for="category">Kategori</label> -->
                <select
                  class="form-control"
                  aria-describedby="categoryError"
                  v-model="form.category"
                >
                  <option value="" selected disabled>-- Select Category --</option>
                  <option
                    v-for="(cat, c) in categories"
                    :key="c"
                    :value="cat.id"
                    >{{ cat.category_name }}</option
                  >
                </select>
                <!-- <small
                  id="categoryError"
                  class="form-text text-muted"
                  v-if="submitted && !$v.form.category.required"
                  >Pilih salah satu category</small
                > -->
              </div>
              <div class="form-group" v-if="fil_division">
                <!-- <label for="category">Division</label> -->
                <select
                  class="form-control"
                  aria-describedby="divisionError"
                  v-model="form.division"
                >
                  <option value="" selected disabled>-- Select Division --</option>
                  <option
                    v-for="(division, index) in divisions"
                    :key="index"
                    :value="division.division_name"
                    >{{ division.division_name }}</option
                  >
                </select>
                <!-- <small
                  id="divisionError"
                  class="form-text text-muted"
                  v-if="submitted && !$v.form.division.required"
                  >Pilih salah satu divisi</small
                > -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <select
                  class="form-control"
                  id="order"
                  v-model="form.order"
                  aria-describedby="orderError"
                >
                  <option value="" selected>ASC</option>
                  <option value="DESC">DESC</option>
                </select>
              </div>
            </div>
             
          </div>


          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn btn-secondary float-right ml-1 btn-sm"
                v-on:click.prevent="downloadPDF('view')">
                <i class="fa fa-eye"></i>&nbsp; Preview as PDF
              </button>

              <b-button
                variant="info"
                class="btn-sm float-right ml-1"
                v-b-tooltip.hover
                title="Export as JSON"
                v-on:click.prevent="downloadPDF('generate_JSON')"
                ><i class="fas fa-fw fa-file-code"></i
              ></b-button>

              <b-button
                variant="success"
                class="btn-sm float-right ml-1"
                v-b-tooltip.hover
                title="Export as Excel"
                v-on:click.prevent="downloadPDF('download_EXCEL')"
                ><i class="fas fa-fw fa-file-excel"></i
              ></b-button>

              <b-button
                variant="primary"
                class="btn-sm float-right ml-1"
                v-b-tooltip.hover
                title="Export as PDF"
                v-on:click.prevent="downloadPDF('download_PDF')"
                ><i class="fas fa-fw fa-file-pdf"></i
              ></b-button>

              

              <!-- <button type="button" class="btn btn-primary float-right" v-on:click.prevent="">
                Download PDF
              </button> -->
              
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="card">
      <div class="card-body m-3">
        <h4>Preview Report (PDF)</h4>
        <div id="viewPDF"></div>
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
import { required, } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      report_name: "",
      form: {
        start_date: "",
        end_date: this.currentDate(),
        category: "",
        division: "",
        filter: "",
        sort: "",
        order: "",
      },
      submitted: false,
      // fil_None: true,
      fil_date: false,
      // fil_year: false,
      fil_category: false,
      fil_division: false,
    };
  },
  validations: {
    form: {
      // start_date: { required },
      // end_date: { required },
      // category: { required },
      // division: { required }
    },
  },
  computed: {
    categories() {
      return this.$store.getters.getAllCategories;
    },
    divisions() {
      return this.$store.getters.getAllDivisions;
    },
  },
  mounted() {
    this.$store.dispatch("getCategory");
    this.$store.dispatch("getDivision");
  },
  methods: {
    downloadPDF(mode) {
      this.submitted = true;
      
      if (this.$v.$invalid) {
        return;
      }

      var data = {};

      switch (this.form.filter) {
        case "date_range":
          data = {
            'filter' : this.form.filter,
            'start_date' : this.form.start_date,
            'end_date' : this.form.end_date,
            'sort' : (this.form.sort == '') ? 'id':this.form.sort,
            'order' : (this.form.order == '') ? 'ASC':this.form.order,
            'mode' : mode,
          };
          break;

        case "this_month":
          data = {
            'filter' : this.form.filter,
            'sort' : (this.form.sort == '') ? 'id':this.form.sort,
            'order' : (this.form.order == '') ? 'ASC':this.form.order,
            'mode' : mode,
          };
          break;

        case "category":
          data = {
            'filter' : this.form.filter,
            'category' : this.form.category,
            'sort' : (this.form.sort == '') ? 'id':this.form.sort,
            'order' : (this.form.order == '') ? 'ASC':this.form.order,
            'mode' : mode,
          };
          break;
        
        case "division":
          data = {
            'filter' : this.form.filter,
            'division' : this.form.division,
            'sort' : (this.form.sort == '') ? 'id':this.form.sort,
            'order' : (this.form.order == '') ? 'ASC':this.form.order,
            'mode' : mode,
          };
          break;

        default:
          data = { 
            'filter' : this.form.filter, 
            'sort' : (this.form.sort == '') ? 'id':this.form.sort,
            'order' : (this.form.order == '') ? 'ASC':this.form.order,
            'mode' : mode,
          };
          break;
      }
      data.report_name = this.report_name

      // var today = this.currentDate();

      axios.post("/api/pdf/generated/report", data)
      .then(response => {
          
          var b64_edit = response.data.data.toString();

          if (mode == 'view')
          {
            // console.log(response.data.x);
            // remove first
            const parent = document.getElementById("viewPDF");
            while (parent.lastElementChild) {
              parent.removeChild(parent.lastElementChild);
            }

            var obj = document.createElement('object');
            obj.style.width = '100%';
            obj.style.height = '530pt';
            obj.type = 'application/pdf';
            obj.data = 'data:application/pdf;base64,' + b64_edit;
            parent.appendChild(obj);
          }
          else if (mode == "download_PDF")
          {
            var link = document.createElement('a');
            link.download = 'Report_Deposit.pdf';
            link.href = 'data:application/pdf;base64,' + b64_edit;
            document.body.appendChild(link);

            link.click();
          }
          else if (mode == "download_EXCEL")
          {
            var file_path = "/downloads/release/" + response.data.data;
            var a = document.createElement("A");
            a.href = file_path;
            a.download = file_path.substr(file_path.lastIndexOf("/") + 1);
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);    
          }
          else if (mode == "generate_JSON")
          {
            // console.log(response.data.data);            

            // var head = "<title>Generated JSON</title>";
            // var ex_head = "<head>"+
            //               "\x3Cscript src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'>\x3C/script>"+
            //               "\x3Cscript src='https://rawgit.com/abodelot/jquery.json-viewer/master/json-viewer/jquery.json-viewer.js'>\x3C/script>"+
            //               "<link href='https://rawgit.com/abodelot/jquery.json-viewer/master/json-viewer/jquery.json-viewer.css' rel='stylesheet'/>"+
            //               "</head>";
            // var cont = "<body style='font-family:Lucida Console; font-size:13px; width:70%;'>"+
            //             "\x3Cscript>$(function(){$('#json-renderer').jsonViewer("+ response.data.data +");});\x3C/script>"+
            //            "<code id='json-renderer'>"+ 
            //            "</code></body>";
let route = this.$router.resolve({name: 'ViewJson', params: {id: response.data.id}});
let payload = {id: response.data.id , data : response.data.data}
// this.$store.dispatch('getJson', payload);
// let route = this.$router.resolve({name: 'routeName', query: {data: "someData"}});
window.open(route.href, '_blank');
            // var tab = window.open('about:blank', '_blank');
            tab.document.write(head + ex_head +''+ cont);
            tab.document.close();

            // download
            var a = document.createElement("a");
            var file = new Blob([response.data.data], {type: 'text/plain'});
            a.href = URL.createObjectURL(file);
            a.download = 'Report_JSON.txt';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);    
          }
      })
      .catch((error) => {
          console.log(error);
      })
      .finally(() => {
          this.loading = false;
      });
    },

    // downloadExcell() {
    //   var data = {};
    //   axios.post("/api/excel/deposit/report/", data)
    //   .then(response => {
    //     console.log(response.data.data);

    //     var file_path = "/downloads/release/" + response.data.data;
    //     var a = document.createElement("A");
    //     a.href = file_path;
    //     a.download = file_path.substr(file_path.lastIndexOf("/") + 1);
    //     document.body.appendChild(a);
    //     a.click();
    //     document.body.removeChild(a);

    //   });
    // },

    currentDate() {
      const current = new Date().toISOString().substr(0, 10);
      // const date = `${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
      return current;
    },

    onFilterChange() {
      // console.log(this.form.filter);
      switch (this.form.filter) 
      {
        case "date_range":
          this.fil_date = true;
          this.fil_category = false;
          this.fil_division = false;
          break;

        case "category":
          this.fil_date = false;
          this.fil_category = true;
          this.fil_division = false;
          break;

        case "division":
          this.fil_date = false;
          this.fil_category = false;
          this.fil_division = true;
          break;

        default:
          this.fil_date = false;
          this.fil_category = false;
          this.fil_division = false;
          break;
      }
    },
  },
};
</script>

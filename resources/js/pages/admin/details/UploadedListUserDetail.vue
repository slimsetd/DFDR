 <template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Contribution Details
      </h1>
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
            <table class="table mt-4">
              <tbody>
                <tr>
                  <th scope="row" style="width: 230px;">
                    <i class="fa fa-user text-xs"></i>&nbsp; &nbsp; Full Name</th>
                  <td><b>: &nbsp; &nbsp;</b> {{ submissions[0].users.name }}</td>
                </tr>
                <tr>
                  <th scope="row">
                    <i class="fa fa-phone text-xs"></i>&nbsp; &nbsp; Phone</th>
                  <td><b>: &nbsp; &nbsp;</b> {{ submissions[0].users.phone }}</td>
                </tr>
                <tr>
                  <th scope="row">
                    <i class="fa fa-envelope text-xs"></i>&nbsp; &nbsp; Email</th>
                  <td><b>: &nbsp; &nbsp;</b> {{ submissions[0].users.email }}</td>
                </tr>
                <tr>
                  <th scope="row">
                    <i class="fa fa-book text-xs"></i>&nbsp; &nbsp; Total Deposit Uploaded</th>
                  <td><b>: &nbsp; &nbsp;</b> {{ submissions.length }}</td>
                </tr>
                <tr>
                  <td colspan="2">
                    <table class="table table-striped table-bordered mt-3">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Deposit Title</th>
                          <th>Category</th>
                          <th>Upload Date</th>
                          <th>Status</th>
                          <th class="text-center" style="width: 190px;">Total Download - View</th>
                          <th class="text-center" style="width: 110px;">File</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(submissions, u) in submissions" :key="u">
                          <td class="text-center">{{ u+1 }}</td>
                          <td>{{ submissions.title }}</td>
                          <td>{{ submissions.category_name }}</td>
                          <td>{{ submissions.date }}</td>
                          <td>
                            <span
                              v-if="submissions.status == 'Approved'"
                              class="badge badge-success"
                            >
                              Approved
                            </span>
                            <span
                              v-if="submissions.status == 'pending'"
                              class="badge badge-warning"
                            >
                              Pending
                            </span>
                            <span
                              v-if="submissions.status == 'Reject'"
                              class="badge badge-danger"
                            >
                              Reject
                            </span>
                          </td>
                          <td class="text-center">{{ submissions.total_download }}</td>
                          <td class="text-center">
                            <b-button
                              variant="primary"
                              class="btn-sm"
                              v-b-tooltip.hover
                              title="Download"
                              v-on:click.prevent="downloadedFile(submissions.file_name)"
                              ><i class="fas fa-fw fa-download"></i
                            ></b-button>
                            <b-button
                              variant="secondary"
                              class="btn-sm"
                              v-b-tooltip.hover
                              title="View"
                              v-on:click.prevent="readFile(submissions.file_name)"
                              ><i class="fas fa-fw fa-eye"></i
                            ></b-button>
                          </td>
                        </tr>  
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>          
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["id"],
  data: function() {
    return {
      loading: true,
      submitted: false,
      faculties: [],
      departments: [],
      years: [],
      idUser: 0,
      submissions: {},
    };
  },
  watch: {
    $route(to, from) {
      this.getUser();
    },
  },
  mounted() {
    const vm = this;
    if (localStorage.getItem("role") == "User") 
    {
      vm.$router.push("/my-upload");
    }
    
    this.getUser();
  },
  computed: {
    rows() {},
    users() {},
  },
  methods: {
    getUser() {
      const vm = this;
      this.idUser = vm.$route.params.id;

      this.loading = true;

      // console.log(this.idUser);
      axios.post("/api/upload-form/user/" + this.idUser).then((res) => {
        this.submissions = res.data.data.form;
        // console.log(res.data.data);
        this.loading = false;
      });
    },

    downloadedFile(filename) {
      // let formData = {
      //   click: "Download",
      // };

      // axios
      // .post("/api/upload-form/increments/" + id, formData)
      // .then((res) => 
      // {
      //   console.log(res.data.data);
      //   if (res) {
          if (filename != null)
          { 
            var file_path = "/storage/uploads/file_upload/" + filename;
            var a = document.createElement("A");
            a.href = file_path;
            a.download = file_path.substr(file_path.lastIndexOf("/") + 1);
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
          }
      //   }
      // });
    },

    readFile(filename) {
      // let formData = {
      //   click: "View",
      // };

      // axios
      // .post("/api/upload-form/increments/" + id, formData)
      // .then((res) => 
      // {
      //   console.log(res.data.data);
      //   if (res) 
      //   {
          if (filename != null)
          {
            // --- view PDF with browser default setting & without IDM force download (Off Page) ---
            var file_path = "/storage/uploads/file_upload/" + filename;
            window.open(file_path, 'fullscreen=yes');
          } 
      //   }
      // });
    },
  },
};
</script>

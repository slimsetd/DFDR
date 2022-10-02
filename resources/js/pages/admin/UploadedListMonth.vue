<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Monthly Deposit {{ this.currentMonth }}</h1>
      <div>
      <router-link
        :to="{ name: 'ReportPdf' }"
        class="btn btn-sm btn-secondary shadow-sm"
        ><i class="fas fa-cube fa-sm text-white-50"></i>&nbsp; Report</router-link
      >
      </div>
    </div>
    <!-- table -->
    <div class="row">
      <div class="col-md-12">
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
              show-empty
            >
              <template #cell(descriptions)="data">
                <div v-html="data.item.description"></div>
              </template>
              <template #cell(status)="data">
                <span
                  v-if="data.item.status == 'Approved'"
                  class="badge badge-success"
                >
                  Approved
                </span>
                <span
                  v-if="data.item.status == 'pending'"
                  class="badge badge-warning"
                >
                  Pending
                </span>
                <span
                  v-if="data.item.status == 'Reject'"
                  class="badge badge-danger"
                >
                  Reject
                </span>
              </template>
              <template #cell(publisher)="data">
                {{ data.item.users.name }}
              </template>
              <template #empty="scope">
                <h4>{{ scope.emptyText }}</h4>
              </template>
              <template #emptyfiltered="scope">
                <h4>{{ scope.emptyFilteredText }}</h4>
              </template>
              <template v-slot:cell(file)="data">
                <b-button
                  variant="primary"
                  class="btn-sm"
                  v-b-tooltip.hover
                  title="Download"
                  v-on:click.prevent="downloadedFile(data.item.file_name, data.item.id)"
                  ><i class="fas fa-fw fa-download"></i
                ></b-button>
                <b-button
                  variant="secondary"
                  class="btn-sm"
                  v-b-tooltip.hover
                  title="View"
                  v-on:click.prevent="readFile(data.item.file_name, data.item.id)"
                  ><i class="fas fa-fw fa-eye"></i
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
          </div>
        </div>
      </div>
    </div>
    <ul style="display: hidden">
      <li v-for="(user, u) in uploads" :key="u">
        {{ user.title }}
      </li>
    </ul>
    <!-- modal -->
    <!-- <b-modal id="modal-1" title="Detail User" size="xl" :hide-footer="true">
      <user-management-detail-component
        :id_user="id_user"
      ></user-management-detail-component>
    </b-modal> -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      id_user: "",
      currentMonth: "x",
      filter: "",
      perPage: 10,
      currentPage: 1,
      fields: ["title", "category", "descriptions", "date", "creator", "publisher", "status", "file"],
      items: [],
    };
  },
  computed: {
    rows() {
      return this.items.length;
    },
    uploads() {
      this.items = this.$store.getters.getUploadedFile;
    },
  },
  mounted() {
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }

    this.$store.dispatch("getUploadedFileMonthly");
    this.currentMonth = this.monthName();
  },
  filters: {
    truncate: function(text, length, suffix) {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      } else {
        return text;
      }
    },
  },
  methods: {
    downloadedFile(filename, id) {
      // console.log(filename);
      let formData = {
        click: "Download",
      };

      axios
      .post("/api/upload-form/increments/" + id, formData)
      .then((res) => 
      {
        // console.log(res.data.data);
        if (res) {

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

          // this.reGetSubmission();
        }
      });
    },

    readFile(filename, id) {
      // --- view PDF with browser default setting & without IDM force download (On Page) ---
      // var file_path = "/storage/uploads/file_upload/" + filename.file_name;
      // var obj = document.createElement('object');
      // obj.style.width = '100%';
      // obj.style.height = '530pt';
      // obj.type = 'application/pdf';
      // obj.data = file_path;
      // window.open(obj);
      // document.getElementById("pdf-view").appendChild(obj);

      let formData = {
        click: "View",
      };

      axios
      .post("/api/upload-form/increments/" + id, formData)
      .then((res) => 
      {
        console.log(res.data.data);
        if (res) 
        {
          if (filename != null)
          {
            // --- view PDF with browser default setting & without IDM force download (Off Page) ---
            var file_path = "/storage/uploads/file_upload/" + filename;
            window.open(file_path, 'fullscreen=yes');
          } 
          // this.reGetSubmission();
        }
      });
    },

    toDetail(id) {
      const vm = this;
      vm.$router.push("/detail-upload/" + id);
    },

    toDelete(id) {
      Vue.swal({
        title: "Hapus Data?",
        text: "Data yang sudah dihapus tidak bisa dikembalikan lagi!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete("/api/upload-form/" + id).then((res) => {
            Vue.swal({
              icon: "success",
              title: "Berhasil dihapus!",
            });
            this.$store.dispatch("getUploadedFile");
          });
        }
      });

      // axios.delete("/api/upload-form/" + id).then((res) => {
      //   Vue.swal({
      //     title: "Hapus Data?",
      //     text: "Data yang sudah dihapus tidak bisa dikembalikan lagi!",
      //     icon: "warning",
      //     showCancelButton: true,
      //     confirmButtonColor: "#3085d6",
      //     cancelButtonColor: "#d33",
      //     confirmButtonText: "Hapus",
      //   }).then((result) => {
      //     if (result.isConfirmed) {
      //       console.log("bisa");
      //       this.$store.dispatch("getUploadedFile");
      //       Vue.swal("Deleted!", "Your data has been deleted.", "success");
      //     }
      //   });
      // });
    },

    monthName()
    {
      var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      var d = new Date();
      return months[d.getMonth()]; // "July" (or current month)
    },
  },
};
</script>

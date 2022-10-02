<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Deposit Approved</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a
      > -->
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
              <!-- <template #cell(user_name)="data">
                {{ data.item.users.name }}
              </template> -->
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
              <template #empty="">
                 <h4>loading in progress</h4>
              </template>
              <template #emptyfiltered="scope">
                <h4>{{ scope.emptyFilteredText }}</h4>
              </template>
              <template v-slot:cell(actions)="data">
                <b-button
                  variant="success"
                  class="btn-sm"
                  v-b-tooltip.hover
                  title="Detail"
                  v-on:click="toDetail(data.item.id)"
                  ><i class="fas fa-fw fa-edit"></i
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
      filter: "",
      perPage: 10,
      currentPage: 1,
      fields: ["title", "descriptions", "status", "actions"],
      items: [],
    };
  },
  computed: {
    rows() {
      return this.items.length;
    },
    uploads() {
      this.items = this.$store.getters.getUploadedFileApproved;
    },
  },
  mounted() {
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }
    this.$store.dispatch("getUploadedFileApproved");
  },
  methods: {
    toDetail(id) {
      const vm = this;
      vm.$router.push("/detail-upload/" + id);
    },
    toDelete(id) {
      axios.delete("/api/user/" + id).then((res) => {
        Vue.swal({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        }).then((result) => {
          if (result.isConfirmed) {
            console.log("bisa");
            this.$store.dispatch("getUsers");
            Vue.swal("Deleted!", "Your data has been deleted.", "success");
          }
        });
      });
    },
  },
};
</script>

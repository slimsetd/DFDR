<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Users Management</h1>
      <router-link
        :to="{ name: 'UserManagementAdd' }"
        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
        ><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp; Add New</router-link
      >
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
            >
              <template #cell(approved)="data">
                <span
                  v-if="data.item.approved == 0"
                  class="badge badge-warning"
                >
                  Waiting
                </span>
                <span
                  v-if="data.item.approved == 1"
                  class="badge badge-success"
                >
                  Approved
                </span>
                <span v-if="data.item.approved == 2" class="badge badge-danger">
                  Reject
                </span>
              </template>
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
          </div>
        </div>
      </div>
    </div>
    <ul style="display: hidden">
      <li v-for="(user, u) in users" :key="u">
        {{ user.name }}
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
      fields: [
        "name",
        "phone",
        "email",
        "date_of_birth",
        "place_of_birth",
        "approved",
        "actions",
      ],
      items: [],
    };
  },
  computed: {
    rows() {
      return this.items.length;
    },
    users() {
      this.items = this.$store.getters.getAllUsers;
    },
  },
  mounted() {
    if (localStorage.getItem("role") == "User") 
    {
      const vm = this;
      vm.$router.push("/my-upload");
    }
    this.$store.dispatch("getUsers");
  },
  methods: {
    toDetail(id) {
      const vm = this;
      vm.$router.push("/detail-user-management/" + id);
    },
    toDelete(id) {
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
          axios.delete("/api/user/" + id).then((res) => {
            Vue.swal({
              icon: "success",
              title: "Successfully Deleted!",
            });
            this.$store.dispatch("getUsers");
          });
        }
      });

      // axios.delete("/api/user/" + id).then((res) => {
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
      //       this.$store.dispatch("getUsers");
      //       Vue.swal("Deleted!", "Your data has been deleted.", "success");
      //     }
      //   });
      // });
    },
  },
};
</script>

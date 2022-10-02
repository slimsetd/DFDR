<template>
  <div>
    <!-- Topbar -->
    <nav
      class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
    >
      <!-- Sidebar Toggle (Topbar) -->
      <button
        id="sidebarToggleTop"
        class="btn btn-link d-md-none rounded-circle mr-3"
      >
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Search -->
      <!-- <form
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
      >
        <div class="input-group">
          <input
            type="text"
            class="form-control bg-light border-0 small"
            placeholder="Search for..."
            aria-label="Search"
            aria-describedby="basic-addon2"
          />
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form> -->

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        <li
          class="nav-item dropdown no-arrow mx-1"
          v-show="is_admin == 'Admin' || is_admin == 'Editor'"
        >
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="alertsDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="fas fa-users fa-fw"></i>
            <!-- Counter - Alerts -->
            <span
              class="badge badge-danger badge-counter"
              v-show="lenghtCountUser > 0"
              >{{ lenghtCountUser }}</span
            >
          </a>
          <!-- Dropdown - Alerts -->
          <div
            class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown"
          >
            <h6 class="dropdown-header">
              New user alert center
            </h6>
            <div v-for="(notif, n) in notif_data" :key="n">
              <a
                class="dropdown-item d-flex align-items-center"
                v-on:click.prevent="toDetailUser(notif.user_id, notif.id)"
              >
                <div class="mr-3">
                  <div class="icon-circle bg-primary">
                    <i class="fas fa-user text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">
                    {{ notif.created_at }}
                  </div>
                  <span class="font-weight-bold" v-show="notif.status == 0">{{
                    notif.message
                  }}</span>
                  <span v-show="notif.status == 1">{{ notif.message }}</span>
                </div>
              </a>
            </div>
            <a class="dropdown-item text-center small text-gray-500" href="#"
              >Show All Alerts</a
            >
          </div>
        </li>

        <li
          class="nav-item dropdown no-arrow mx-1"
          v-show="is_admin === 'Admin' || is_admin == 'Editor'"
        >
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="alertsDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span
              class="badge badge-danger badge-counter"
              v-show="lenghtCountDeposit > 0"
              >{{ lenghtCountDeposit }}</span
            >
          </a>
          <!-- Dropdown - Alerts -->
          <div
            class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown"
          >
            <h6 class="dropdown-header">
              New deposit alert center
            </h6>
            <div v-for="(notif, n) in notif_data_deposit" :key="n">
              <a
                class="dropdown-item d-flex align-items-center"
                href="#"
                v-on:click.prevent="
                  toDetailDeposit(notif.upload_form_id, notif.id)
                "
              >
                <div class="mr-3">
                  <div class="icon-circle bg-primary">
                    <i class="fas fa-user text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">
                    {{ notif.created_at }}
                  </div>
                  <span class="font-weight-bold" v-show="notif.status == 0">{{
                    notif.message
                  }}</span>
                  <span v-show="notif.status == 1">{{ notif.message }}</span>
                </div>
              </a>
            </div>
            <a class="dropdown-item text-center small text-gray-500" href="#"
              >Show All Alerts</a
            >
          </div>
        </li>

        <li
          class="nav-item dropdown no-arrow mx-1"
          v-show="is_admin === 'User'"
        >
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="alertsDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span
              class="badge badge-danger badge-counter"
              v-show="lenghtCountMyAlert > 0"
              >{{ lenghtCountMyAlert }}</span
            >
          </a>
          <!-- Dropdown - Alerts -->
          <div
            class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown"
          >
            <h6 class="dropdown-header">
              Deposit alert center
            </h6>

            <div v-for="(notif, n) in notif_data_deposit" :key="n">
              <a
                class="dropdown-item d-flex align-items-center"
                v-on:click.prevent="
                  toDetailMyDeposit(notif.deposit_id, notif.id)
                "
              >
                <div class="mr-3">
                  <div class="icon-circle bg-primary">
                    <i class="fas fa-user text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">
                    {{ notif.created_at }}
                  </div>
                  <span class="font-weight-bold" v-show="notif.status == 0">{{
                    notif.message
                  }}</span>
                  <span v-show="notif.status == 1">{{ notif.message }}</span>
                </div>
              </a>
            </div>
            <!-- <a class="dropdown-item text-center small text-gray-500" href="#"
              >Show All Alerts</a
            > -->
          </div>
        </li>
        <!-- Nav Item - Messages -->

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="userDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{
              userdata.name
            }}</span>
            <!-- <img
              class="img-profile rounded-circle"
              src="img/undraw_profile.svg"
            /> -->
          </a>
          <!-- Dropdown - User Information -->
          <div
            class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown"
          >
            <router-link :to="{ name: 'UserProfile' }" class="dropdown-item">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </router-link>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" v-on:click="handleLogout()">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- End of Topbar -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      userdata: {},
      notif_data: [],
      notif_data_deposit: [],
      jumlah: "",
      jumlah_deposit: "",
      is_admin: localStorage.getItem("role"),
      lenghtCountMyAlert: "",
      lenghtCountDeposit: "",
      lenghtCountUser: "",
    };
  },
  mounted() {
    this.userdata = JSON.parse(localStorage.getItem("user"));
    if (this.is_admin == "Admin" || this.is_admin == "Editor") {
      this.getNotification();
      this.getNotificationDeposit();
    } else if ((this.is_admin = "User")) {
      this.getMyAlertDeposit();
    }
  },
  watch: {
    $route(to, from) {
      console.log("change");
      if (this.is_admin == "Admin" || this.is_admin == "Admin") {
        this.getNotification();
        this.getNotificationDeposit();
      } else if ((this.is_admin = "User")) {
        this.getMyAlertDeposit();
      }
    },
  },
  methods: {
    handleLogout() {
      Vue.swal({
        title: "Are you sure?",
        text: "Log out your session and leave this page.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "secondary",
        cancelButtonText: "Cancel",
        confirmButtonText: "Logout",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$store.dispatch("getLogout").then(() => {
            // Vue.swal({ icon: "success", title: "Logout Success!" });
            this.$router.push("/").then(() => {
              window.location.reload();
            });
          });
        }
      });
    },

    getNotification() {
      axios.get("/api/get-notification-user").then((res) => {
        this.notif_data = res.data.data.listNotif;
        this.lenghtCountUser = res.data.data.length;
      });
    },

    getNotificationDeposit() {
      axios.get("/api/get-notification-upload").then((res) => {
        this.notif_data_deposit = res.data.data.listNotif;
        this.lenghtCountDeposit = res.data.data.length;
      });
    },

    getMyAlertDeposit() {
      var user_id = localStorage.getItem("user_id");
      axios.get("/api/get-notification-approval/" + user_id).then((res) => {
        this.notif_data_deposit = res.data.data.listNotif;
        this.lenghtCountMyAlert = res.data.data.length;
      });
    },

    toDetailMyDeposit(id, notifId) {
      axios.get("/api/read-notification-approval/" + notifId).then((res) => {
        console.log("res" + res);
      });
      this.$router
        .push("/detail-my-upload/" + id)
        .then(() => {})
        .catch(() => {});
    },

    toDetailDeposit(id, notifId) {
      axios.get("/api/read-notification-upload/" + notifId).then((res) => {
        console.log("res" + res);
      });
      this.$router
        .push("/detail-upload/" + id)
        .then(() => {})
        .catch(() => {});
    },

    toDetailUser(id, notifId) {
      axios.get("/api/read-notification-user/" + notifId).then((res) => {
        console.log("res" + res);
      });
      this.$router
        .push("/detail-user-management/" + id)
        .then(() => {})
        .catch(() => {});
    },
  },
};
</script>

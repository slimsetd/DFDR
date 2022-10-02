<template>
  <div>
    <div v-show="userdata.role == 'Admin'">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <router-link
          :to="{ name: 'ReportPdf' }"
          class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
          ><i class="fas fa-cube fa-sm text-white-50"></i>&nbsp; Report</router-link
        >
      </div>

      <!-- Content Row -->
      <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div
                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                  >
                    All Creator
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ this.dashboard_data.all_creator }}
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div
                    class="text-xs font-weight-bold text-success text-uppercase mb-1"
                  >
                    All Editor
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ this.dashboard_data.all_editor }}
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div
                    class="text-xs font-weight-bold text-success text-uppercase mb-1"
                  >
                    All Deposit
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ this.dashboard_data.all_file_upload }}
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div
                    class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                  >
                    All User
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ this.dashboard_data.all_user }}
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div
                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                  >
                    All Deposit by Division
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ this.dashboard_data.all_file_upload_by_division }}
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div
                    class="text-xs font-weight-bold text-success text-uppercase mb-1"
                  >
                    All Deposit By Category
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ this.dashboard_data.all_file_upload_by_category }}
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-show="userdata.role == 'User'">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a
          href="#"
          class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
          ><i class="fas fa-download fa-sm text-white-50"></i> Generate
          Report</a
        > -->
      </div>
      <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div
                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                  >
                    All Deposit
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ this.dashboard_data.all_file_upload_approve }} item
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div
                    class="text-xs font-weight-bold text-success text-uppercase mb-1"
                  >
                    My Contribution
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <router-link :to="{ name: 'MyUpload' }"
                      >{{ this.dashboard_data.my_file_upload_deposite }} Item
                    </router-link>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div
                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                  >
                    All Deposit by Category
                  </div>
                  <bar-chart-category></bar-chart-category>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import barChartCategory from "../components/barChartCategoryApproved.vue";

export default {
  data() {
    return {
      userdata: {},
      token: localStorage.getItem("token"),
      dashboard_data: [],
    };
  },
  mounted() {
    this.getDashboardData();
    this.userdata = JSON.parse(localStorage.getItem("user"));
    console.log(this.userdata);
    console.log(this.token);
  },
  components: {
    barChartCategory,
  },
  methods: {
    getDashboardData() {
      axios.get("/api/list/count/dashboard").then((res) => {
        this.profile = res.data.data.user;
        this.dashboard_data = res.data.data;
        console.log(res);
      });
    },
  },
};
</script>

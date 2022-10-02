<template>
  <div id="wrapper">
    <sidebar-user-component></sidebar-user-component>
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <header-user-component></header-user-component>
        <div class="container-fluid">
          <!-- Page Heading -->
          <!-- <div
            class="d-sm-flex align-items-center justify-content-between mb-4"
          >
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a
              href="#"
              class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
              ><i class="fas fa-download fa-sm text-white-50"></i> Generate
              Report</a
            >
          </div> -->
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      userdata: {},
    };
  },
  mounted() {
    this.userdata = JSON.parse(localStorage.getItem("user"));
    console.log(this.userdata);
  },
};
</script>

<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Database Backup</h1>
    </div>
    <div class="row">

      <div class="col-md-9">
        <div class="card p-3">
          <div class="card-body">
            <p class="mb-1">
              <i class="fa fa-exclamation-triangle text-warning"></i>&nbsp;
              <strong>Warnings!</strong> Before exporting your database please read several informations we provide below :</p>
            <p class="pb-2">
              <ul>
                <li>Exporting process covers all existing data in your database including all tables structure</li>
                <li>Exporting process <strong>will not</strong> delete your recent data in database</li>
                <li>Exporting time depends on how large your database is. Please be patient and wait up to finish</li>
                <li>Exporting format as (.sql) file in order to re-import purpose</li>
              </ul>
            </p>
            <p class="mb-1">
              <i class="fa fa-info-circle text-info"></i>&nbsp;
              <strong>Re-Import</strong> notes :
            </p>
            <p class="pb-2">
              <ul>
                <li>Go to your database management panel and choose database to Import file</li>
                <li>You <strong>don't need to</strong> re-create all the tables, the file covers all of your tables structure information</li>
                <li>Please <strong>uncheck</strong> <i>'Enable foreign key checks'</i> option to prevent error during Import process</li>
                <li>We strongly recommend you to <strong>restart</strong> Digital Repository Framework after Importing process</li>
              </ul>
            </p>
            
            <hr style="border-top: 1px dashed #dbdbdb;">
            <button
              type="button"
              class="btn btn-primary btn-sm shadow-sm mt-1"
              v-on:click.prevent="onExport()"
            >
              <i class="fas fa-download fa-sm text-white-50"></i>&nbsp; Export Database
            </button>
          </div>
        </div>
      </div>
    
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      
    };
  },
  computed: {
    rows() {},
    categories() {},
  },
  mounted() {
    if (localStorage.getItem("role") == "User" || localStorage.getItem("role") == "Editor") {
      this.$router.push("/my-upload");
    }
    
  },
  methods: {
     onExport() {
       console.log("X");

       axios
        .get("/api/database/export")
        .then((res) => {
          // console.log(res.data);
          var file_path = "/downloads/db/" + res.data.data.data;
          var a = document.createElement("A");
          a.href = file_path;
          a.download = file_path.substr(file_path.lastIndexOf("/") + 1);
          document.body.appendChild(a);
          a.click();
          // window.open(file_path);
          document.body.removeChild(a);
        })
        .catch(function(error) {
          Vue.swal({
            icon: "error",
            title: "Export Failed!",
          });
          console.log(error);
        });
     },   
  },
};
</script>

<template>
  <div style="background-color: #4e73df">
    <!-- Sidebar -->
    <ul
      v-if="role == 'user'"
      class="navbar-nav sidebar sidebar-dark accordion"
      id="accordionSidebar"
    >
      <!-- Sidebar - Brand -->
      <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="#"
      >
        <div class="sidebar-brand-text mx-3">Digital Repository<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <router-link :to="{ name: 'Dashboard' }" class="nav-link"
          ><i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></router-link
        >
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">
        Main Menu
      </div>

      <!-- User Management -->
      <!-- <li class="nav-item">
        <router-link :to="{ name: 'MyUpload' }" class="nav-link"
          ><i class="fas fa-fw fa-users"></i>
          <span>My Upload</span></router-link
        >
      </li> -->
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseTwo"
          aria-expanded="true"
          aria-controls="collapseTwo"
        >
          <i class="fas fa-fw fa-book"></i>
          <span>Deposits</span>
        </a>
        <div
          id="collapseTwo"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'UploadFile' }" class="collapse-item"
              >Upload Deposit</router-link
            >
            <router-link :to="{ name: 'UploadedFileRead' }" class="collapse-item"
              >All Deposits</router-link
            >
            <router-link :to="{ name: 'MyUpload' }" class="collapse-item"
              >My Deposit</router-link
            >
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>

    <ul
      v-if="role == 'admin'"
      class="navbar-nav sidebar sidebar-dark accordion"
      id="accordionSidebar"
    >
      <!-- Sidebar - Brand -->
      <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="#"
      >
        <div class="sidebar-brand-text mx-3">Digital Repository<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <router-link :to="{ name: 'Dashboard' }" class="nav-link"
          ><i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></router-link
        >
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">
        Main Menu
      </div>

      <!-- Master Data-->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseTwo"
          aria-expanded="true"
          aria-controls="collapseTwo"
        >
          <i class="fas fa-fw fa-archive"></i>
          <span>Data Master</span>
        </a>
        <div
          id="collapseTwo"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'MasterCategory' }" class="collapse-item"
              >Category</router-link
            >
            <router-link :to="{ name: 'MasterDegree' }" class="collapse-item"
              >Subject</router-link
            >
            <router-link
              :to="{ name: 'MasterDepartment' }"
              class="collapse-item"
              >Department</router-link
            >
            <router-link :to="{ name: 'MasterDivision' }" class="collapse-item"
              >Division</router-link
            >
            <router-link :to="{ name: 'MasterFaculty' }" class="collapse-item"
              >Faculty</router-link
            >
            <router-link :to="{ name: 'MasterLanguages' }" class="collapse-item"
              >Languages</router-link
            >
            <router-link :to="{ name: 'MasterYear' }" class="collapse-item"
              >Year</router-link
            >
            <router-link :to="{ name: 'DataBackup' }" class="collapse-item"
              >Database Backup</router-link
            >
            <router-link :to="{ name: 'DataVersion' }" class="collapse-item"
              >Software Version</router-link
            >
          </div>
        </div>
      </li>

      <!-- News Management -->
      <li class="nav-item">
        <router-link :to="{ name: 'MasterNews' }" class="nav-link"
          ><i class="fas fa-fw fa-newspaper"></i>
          <span>News Management</span></router-link
        >
      </li>

      <!-- User Management -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapsethree4"
          aria-expanded="true"
          aria-controls="collapsethree4"
        >
          <i class="fas fa-fw fa-users"></i>
          <span>Users Management</span>
        </a>
        <div
          id="collapsethree4"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'UserManagement' }" class="collapse-item"
              >List Users</router-link
            >
            <router-link :to="{ name: 'BulkUser' }" class="collapse-item"
              >Export & Import User</router-link
            >
            <!-- <router-link :to="{ name: 'MasterDegree' }" class="collapse-item"
              >Deposit by Category</router-link
            > -->
          </div>
        </div>
      </li>

 <!-- User Management -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapsethreeweb"
          aria-expanded="true"
          aria-controls="collapsethreeweb"
        >
          <i class="fas fa-fw fa-wrench"></i>
          <span>Web Management</span>
        </a>
        <div
          id="collapsethreeweb"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
              <router-link :to="{ name: 'TemplateSlider' }" class="collapse-item"
              >Slider</router-link
            >
              <router-link :to="{ name: 'TemplateFooterImage' }" class="collapse-item"
              >Footer image</router-link
            >
            <router-link :to="{ name: 'TemplateHome' }" class="collapse-item"
              >Home</router-link
            >
            <router-link :to="{ name: 'TemplateSubmission' }" class="collapse-item"
              >Submission</router-link
            >
            <router-link :to="{ name: 'TemplateAbout' }" class="collapse-item"
              >About us</router-link
            >

              <router-link :to="{ name: 'TemplateContact' }" class="collapse-item"
              >Contact</router-link
            >
          </div>
        </div>
      </li>
      <!-- Editor Management -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseEditor"
          aria-expanded="true"
          aria-controls="collapseEditor"
        >
          <i class="fas fa-fw fa-users"></i>
          <span>Editors Management</span>
        </a>
        <div
          id="collapseEditor"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'EditorManagement' }" class="collapse-item"
              >List Editors</router-link
            >
            <router-link :to="{ name: 'BulkEditor' }" class="collapse-item"
              >Export & Import Editors</router-link
            >
          </div>
        </div>
      </li>

      <!-- Upload deposit -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapsethree"
          aria-expanded="true"
          aria-controls="collapsethree"
        >
          <i class="fas fa-fw fa-book"></i>
          <span>Master Deposit</span>
        </a>
        <div
          id="collapsethree"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'MyUpload' }" class="collapse-item"
              >My Deposit</router-link
            >
            <router-link :to="{ name: 'UploadedFile' }" class="collapse-item"
              >All Deposit</router-link
            >
            <router-link
              :to="{ name: 'UploadedFileApproved' }"
              class="collapse-item"
              >Deposit Approved</router-link
            >
            <!-- <router-link :to="{ name: 'MasterDegree' }" class="collapse-item"
              >Deposit by Category</router-link
            > -->
          </div>
        </div>
      </li>

      <!-- Chart deposit -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseChart"
          aria-expanded="true"
          aria-controls="collapseChart"
        >
          <i class="fas fa-fw fa-tasks"></i>
          <span>Data Chart</span>
        </a>
        <div
          id="collapseChart"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'ReportChart' }" class="collapse-item"
              >All Deposit</router-link
            >
            <router-link :to="{ name: 'ReportChartCategory' }" class="collapse-item"
              >By Filters</router-link
            >
            <router-link :to="{ name: 'ReportChartEditor' }" class="collapse-item"
              >By Editor</router-link
            >
          </div>
        </div>
      </li>

      <!-- Report deposit -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseFour"
          aria-expanded="true"
          aria-controls="collapseFour"
        >
          <i class="fas fa-fw fa-cube"></i>
          <span>Reports</span>
        </a>
        <div
          id="collapseFour"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'ReportPdf' }" class="collapse-item"
              >All Deposit</router-link
            >
            <router-link :to="{ name: 'UploadedFileUser' }" class="collapse-item"
              >By User Contribution</router-link
            >
            <router-link :to="{ name: 'UploadedFileMonth' }" class="collapse-item"
              >By Month Submission</router-link
            >
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>

    <ul
      v-if="role == 'editor'"
      class="navbar-nav sidebar sidebar-dark accordion"
      id="accordionSidebar"
    >
      <!-- Sidebar - Brand -->
      <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="#"
      >
        <div class="sidebar-brand-text mx-3">Digital Repository<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">
        Main Menu
      </div>

      <!-- Master Data-->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseTwo"
          aria-expanded="true"
          aria-controls="collapseTwo"
        >
          <i class="fas fa-fw fa-archive"></i>
          <span>Data Master</span>
        </a>
        <div
          id="collapseTwo"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'MasterCategory' }" class="collapse-item"
              >Category</router-link
            >
            <router-link :to="{ name: 'MasterDegree' }" class="collapse-item"
              >Subject</router-link
            >
            <router-link
              :to="{ name: 'MasterDepartment' }"
              class="collapse-item"
              >Department</router-link
            >
            <router-link :to="{ name: 'MasterDivision' }" class="collapse-item"
              >Division</router-link
            >
            <router-link :to="{ name: 'MasterFaculty' }" class="collapse-item"
              >Faculty</router-link
            >
            <router-link :to="{ name: 'MasterLanguages' }" class="collapse-item"
              >Languages</router-link
            >

            <router-link :to="{ name: 'MasterYear' }" class="collapse-item"
              >Year</router-link
            >
          </div>
        </div>
      </li>

      <!-- News Management -->
      <li class="nav-item">
        <router-link :to="{ name: 'MasterNews' }" class="nav-link"
          ><i class="fas fa-fw fa-newspaper"></i>
          <span>News Management</span></router-link
        >
      </li>

      <!-- User Management -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapsethree4"
          aria-expanded="true"
          aria-controls="collapsethree4"
        >
          <i class="fas fa-fw fa-users"></i>
          <span>Users Management</span>
        </a>
        <div
          id="collapsethree4"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'UserManagement' }" class="collapse-item"
              >List Users</router-link
            >
            <router-link :to="{ name: 'BulkUser' }" class="collapse-item"
              >Export & Import User</router-link
            >
            <!-- <router-link :to="{ name: 'MasterDegree' }" class="collapse-item"
              >Deposit by Category</router-link
            > -->
          </div>
        </div>
      </li>

      <!-- upload deposit -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapsethree"
          aria-expanded="true"
          aria-controls="collapsethree"
        >
          <i class="fas fa-fw fa-book"></i>
          <span>Master Deposit</span>
        </a>
        <div
          id="collapsethree"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'MyUpload' }" class="collapse-item"
              >My Deposit</router-link
            >
            <router-link :to="{ name: 'UploadedFile' }" class="collapse-item"
              >All Deposit</router-link
            >
            <router-link
              :to="{ name: 'UploadedFileApproved' }"
              class="collapse-item"
              >Deposit Approved</router-link
            >
            <!-- <router-link :to="{ name: 'MasterDegree' }" class="collapse-item"
              >Deposit by Category</router-link
            > -->
          </div>
        </div>
      </li>

      <!-- Chart deposit -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseChart"
          aria-expanded="true"
          aria-controls="collapseChart"
        >
          <i class="fas fa-fw fa-tasks"></i>
          <span>Data Chart</span>
        </a>
        <div
          id="collapseChart"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'ReportChart' }" class="collapse-item"
              >All Deposit</router-link
            >
            <router-link :to="{ name: 'ReportChartCategory' }" class="collapse-item"
              >By Filters</router-link
            >
          </div>
        </div>
      </li>

      <!-- Report deposit -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseFour"
          aria-expanded="true"
          aria-controls="collapseFour"
        >
          <i class="fas fa-fw fa-cube"></i>
          <span>Reports</span>
        </a>
        <div
          id="collapseFour"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link :to="{ name: 'ReportPdf' }" class="collapse-item"
              >All Deposit</router-link
            >
            <router-link :to="{ name: 'UploadedFileUser' }" class="collapse-item"
              >By User Contribution</router-link
            >
            <router-link :to="{ name: 'UploadedFileMonth' }" class="collapse-item"
              >By Month Submission</router-link
            >
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>

    <!-- End of Sidebar -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      userdata: {},
      token: localStorage.getItem("token"),
      role: "",
    };
  },
  mounted() {
    this.userdata = JSON.parse(localStorage.getItem("user"));
    this.role = this.userdata.role.toLowerCase().trim();
    console.log(this.userdata);
    console.log(this.role);
  },
  methods: {},
};
</script>

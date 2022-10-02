<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Submission template</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a
      > -->
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <b-row class="mb-3">
              <b-col md="12">
                <form>
                  <div>
                    <h3>Submission description</h3>
                    <label for="news_title">Content type</label>
                    <input
                      type="text"
                      disabled
                      class="form-control"
                      id="news_title"
                      aria-describedby="newsError"
                      placeholder="Enter news title"
                      v-model="form.content_type"
                    />
                  </div>

                  <div class="form-group">
                    <label for="news_desc">Content</label>
                    <vue-editor v-model="form.content" />
                    <small
                      id="descError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form.content.required"
                      ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                      Description is required</small
                    >
                  </div>

                  <button
                    type="submit"
                    class="btn btn-sm btn-success"
                    v-on:click.prevent="handleSubmitUpdate('submission')"
                  >
                    Submit
                  </button>
                  <button
                    type="submit"
                    class="btn btn-sm btn-secondary"
                    v-if="updated == true"
                    v-on:click.prevent="clearData()"
                  >
                    Cancel
                  </button>
                </form>
              </b-col>
            
            </b-row>
          </div>
        </div>
      </div>
        <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <b-row class="mb-3">
              <b-col md="12">
                <form>
                  <div>
                        <h3>License</h3>
                    <label for="news_title">Content type</label>
                    <input
                      type="text"
                      disabled
                      class="form-control"
                      id="news_title"
                      aria-describedby="newsError"
                      placeholder="Enter news title"
                      v-model="form_license.content_type"
                    />
                  </div>

                  <div class="form-group">
                    <label for="news_desc">Content</label>
                    <vue-editor v-model="form_license.content" />
                    <small
                      id="descError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form_license.content.required"
                      ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                      License is required</small
                    >
                  </div>

                  <button
                    type="submit"
                    class="btn btn-sm btn-success"
                    v-on:click.prevent="handleSubmitUpdate('license')"
                  >
                    Submit
                  </button>
                  <button
                    type="submit"
                    class="btn btn-sm btn-secondary"
                    v-if="updated == true"
                    v-on:click.prevent="clearData()"
                  >
                    Cancel
                  </button>
                </form>
              </b-col>
            
            </b-row>
          </div>
        </div>
      </div>
    </div>

    <!-- How to submit -->
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">how to submit</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a
      > -->
    </div>
    <div class="row">
      <div class="col-md-8">
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
              :items="how_submits"
              :fields="fields"
              :per-page="perPage"
              :current-page="currentPage"
              :filter="filter"
            >
              <template #cell(content)="data">
                <div v-html="data.item.content"></div>
              </template>
              <template #cell(content_type)="data">
                <div>{{ getContentData(data.item.content_type_id) }}</div>
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
                <!-- // add by mw -->
                <!-- <b-button
                  variant="danger"
                  class="btn-sm"
                  v-b-tooltip.hover
                  title="Delete"
                  @click="toDelete(data.item.id)"
                  ><i class="fas fa-fw fa-trash-alt"></i
                ></b-button> -->
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
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="news_title">Content type</label>
                <input
                  type="text"
                  disabled
                  class="form-control"
                  id="news_title"
                  aria-describedby="newsError"
                  placeholder="Enter news title"
                  v-model="form_submit.content_type"
                />
              </div>

              <div class="form-group">
                <label for="news_desc">Content</label>
                <vue-editor v-model="form_submit.content" />
                <small
                  id="descError"
                  class="form-text text-muted"
                  v-if="submitted && !$v.form_submit.content.required"
                  ><i class="fa fa-info-circle text-xs"></i>&nbsp; Description
                  is required</small
                >
              </div>

              <button
                type="submit"
                class="btn btn-sm btn-success"
                v-on:click.prevent="handleSubmitUpdate('how-submit')"
              >
                Submit
              </button>
              <button
                type="submit"
                class="btn btn-sm btn-secondary"
                v-if="updated == true"
                v-on:click.prevent="clearData()"
              >
                Cancel
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- User guide -->
      <div class="row">
      <div class="col-md-6">
        <div class="card mt-6">
          <div class="card-body">
            <b-row class="mb-3">
              <b-col md="12">
                <form>
                  <div>
                    <h3>User guide</h3>
                    <label for="news_title">Content type</label>
                    <input
                      type="text"
                      disabled
                      class="form-control"
                      id="news_title"
                      aria-describedby="newsError"
                      placeholder="Enter news title"
                      v-model="form_user_guide.content_type"
                    />
                  </div>

                  <div class="form-group">
                    <label for="news_desc">Content</label>
                    <vue-editor v-model="form_user_guide.content" />
                    <small
                      id="descError"
                      class="form-text text-muted"
                      v-if="submitted && !$v.form_user_guide.content.required"
                      ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                      User guide is required</small
                    >
                  </div>

                  <button
                    type="submit"
                    class="btn btn-sm btn-success"
                    v-on:click.prevent="handleSubmitUpdate('user-guide')"
                  >
                    Submit
                  </button>
                  <button
                    type="submit"
                    class="btn btn-sm btn-secondary"
                    v-if="updated == true"
                    v-on:click.prevent="clearData()"
                  >
                    Cancel
                  </button>
                </form>
              </b-col>
            
            </b-row>
          </div>
        </div>
      </div>
      
    </div>

  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      id: "",
      filter: "",
      perPage: 10,
      currentPage: 1,
      fields: ["content", "content_type", "actions"],
      items: [],
      how_submits: [],

      form: {
        content: "",
        content_type: "",
        // add by mw
        // news_title: "",
        // news_desc: "",
        // news_thumb: "",
      },
      form_submit: {
        id: "",
        content: "",
        content_type: "",
      },
       form_license: {
        id: "",
        content: "",
        content_type: "",
      },
        form_user_guide: {
        id: "",
        content: "",
        content_type: "",
      },
      submitted: false,
      updated: false,
      data_update: "",
    };
  },
  validations: {
    form: {
      //add by mw
      content: { required },
      // news_title: { required },
      // news_desc: { required },
      // news_thumb: { required },
    },
    form_submit: {
      //add by mw
      content: { required },
      // news_title: { required },
      // news_desc: { required },
      // news_thumb: { required },
    },
     form_license: {
      //add by mw
      content: { required },
      // news_title: { required },
      // news_desc: { required },
      // news_thumb: { required },
    },
      form_user_guide: {
      //add by mw
      content: { required },
      // news_title: { required },
      // news_desc: { required },
      // news_thumb: { required },
    },
  },
  computed: {
    rows() {
      return this.items.length;
    },
    // news() {
    //   this.items = this.$store.getters.getAllNews;
    // },
  },
  mounted() {
    this.getSubmission();
    this.getHowToSubmit();
    this.getLicense();
    this.getUserGuide();
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }
    this.$store.dispatch("getNews");
  },
  methods: {
    getSubmission() {
      axios.get("/api/template/submission").then((response) => {
        this.id = response.data.data.id;
        this.form.content_type = "Description";
        this.form.content = response.data.data.content;
      });
    },
     getUserGuide() {
      axios.get("/api/template/user-guide").then((response) => {
        this.form_user_guide.id = response.data.data.id;
        this.form_user_guide.content_type = "User guide";
        this.form_user_guide.content = response.data.data.content;
      });
    },
      getLicense() {
      axios.get("/api/template/license/1").then((response) => {
        this.form_license.id = response.data.data.id;
        this.form_license.content_type = "License";
        this.form_license.content = response.data.data.content;
      });
    },
    getHowToSubmit() {
      axios.get("/api/template/how-submit").then((response) => {
        this.how_submits = response.data.data;
        //   this.id = response.data.data.id;
        // this.form.content_type = "Description";
        // this.form.content = response.data.data.content;
      });
    },
    // add by mw
    getContentData(id) {
      // 1 = thesis & disertation, 2 = faculty & staff work, 3 = graduate work non thesis, 4 = undergrated work
      switch (id) {
        case 1:
          return "Thesis & disertation";
          break;
        case 2:
          return "Faculty & staff work";
          break;
        case 3:
          return "Graduate work (non thesis)";
          break;
        case 4:
          return "Undergrated work";
          break;

        default:
          return "Address footer";
          break;
      }
    },

    handleUploadPhoto() {
      this.form.news_thumb = this.$refs.file.files[0];
      console.log(this.form.news_thumb);
    },
    handleCreatedNews() {
      this.submitted = true;
      var vm = this;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      console.log(this.form);
      let formData = new FormData();
      formData.append("news_title", this.form.news_title);
      formData.append("news_desc", this.form.news_desc);
      formData.append("news_thumb", this.form.news_thumb);
      axios.post("/api/news", formData).then((res) => {
        console.log(res);
        Vue.swal({
          icon: "success",
          title: "Successfully Added!",
        });
        this.$store.dispatch("getNews");
        this.clearData();
      });
    },

    toDelete(id) {
      console.log("delete" + id);
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
          axios.delete("/api/news/" + id).then((res) => {
            // console.log("bisa");
            Vue.swal({
              icon: "success",
              title: "Successfully Deleted!",
            });
            this.$store.dispatch("getNews");
          });
        }
      });
    },

    toDetail(id) {
      // this.updated = true;
      axios.get("/api/template/how-submit/" + id).then((res) => {
        this.form_submit.content_type = this.getContentData(
          res.data.data.content_type_id
        );
        this.form_submit.content = res.data.data.content;
        this.form_submit.id = res.data.data.id;
        console.log(this.id);
      });
    },

    handleSubmitUpdate(apiRoute) {
      let id = "";
      let content = "";

      if (apiRoute == "how-submit") {
        id = this.form_submit.id;
        content = this.form_submit.content;
      } else if(apiRoute == 'license'){
        id = this.form_license.id;
        content = this.form_license.content;
      } 
      else if(apiRoute == 'user-guide'){
        id = this.form_user_guide.id;
        content = this.form_user_guide.content;
      } 
      else {
        id = this.id;
        content = this.form.content;
      }

      let urlApi = axios
        .put(`/api/template/${apiRoute}/${id}`, {
          content: content,
        })
        .then((res) => {
          console.log(res);
          Vue.swal({
            icon: "success",
            title: "Successfully Updated!",
          });
          // this.clearData();
          //add by mw
          this.getSubmission();
          this.getHowToSubmit();
          this.getLicense();
        })
        .catch(function (error) {
          Vue.swal({
            icon: "error",
            title: "Failed to Update!",
          });
          console.log(error);
        });
    },

    clearData() {
      // this.submitted = false;
      // this.updated = false;
      this.form.content_type = "";
      this.form.content = "";
      // this.form.news_thumb = "";
      // this.$refs.file.value = null;
      this.id = "";
    },
  },
};
</script>

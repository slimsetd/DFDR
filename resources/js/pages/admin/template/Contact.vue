<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Contact template</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a
      > -->
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
                      ><i class="fa fa-info-circle text-xs"></i>&nbsp; Address
                      is required</small
                    >
                  </div>

                  <button
                    type="submit"
                    class="btn btn-sm btn-success"
                    v-on:click.prevent="btnUpdate()"
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
        id: "",
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
    this.getContact();
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }
    this.$store.dispatch("getNews");
  },
  methods: {
    getContact() {
      axios.get("/api/template/contact/1").then((response) => {
        this.form.id = response.data.data.id;
        this.form.content_type = "Address";
        this.form.content = response.data.data.content;
      });
    },
    btnUpdate() {
      axios
        .put(`/api/template/contact/${this.form.id}`, {
          content: this.form.content,
        })
        .then((res) => {
          console.log(res);
          Vue.swal({
            icon: "success",
            title: "Successfully Updated!",
          });
        //   this.clearData();
          //add by mw
         this.getContact()
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
  // add by mw
};
</script>

<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Master News</h1>
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
              :items="items"
              :fields="fields"
              :per-page="perPage"
              :current-page="currentPage"
              :filter="filter"
            >
              <template #cell(news_descs)="data">
                <div v-html="data.item.news_desc"></div>
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
            <ul style="display: hidden">
              <li v-for="(cat, c) in news" :key="c">
                {{ cat.news_title }}
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4>Form News</h4>
            <form>
              <div class="form-group">
                <label for="news_title">News Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="news_title"
                  aria-describedby="newsError"
                  placeholder="Enter news title"
                  v-model="form.news_title"
                />
                <small
                  id="newsError"
                  class="form-text text-muted"
                  v-if="submitted && !$v.form.news_title.required"
                  ><i class="fa fa-info-circle text-xs"></i>&nbsp; Title is required</small
                >
              </div>
              <div class="form-group">
                <label for="news_desc">Description</label>
                <vue-editor v-model="form.news_desc" />
                <small
                  id="descError"
                  class="form-text text-muted"
                  v-if="submitted && !$v.form.news_desc.required"
                  ><i class="fa fa-info-circle text-xs"></i>&nbsp; Description is required</small
                >
              </div>
              <div class="form-group">
                <label for="photo">News Thumbnail</label>
                <input
                  type="file"
                  ref="file"
                  v-on:change="handleUploadPhoto()"
                  class="form-control-file"
                  id="photo"
                />
                <small
                  id="addresError"
                  class="form-text text-muted"
                  v-if="submitted && !$v.form.news_thumb.required"
                  ><i class="fa fa-info-circle text-xs"></i>&nbsp; News Thumbnail is required</small
                >
              </div>
              <button
                type="submit"
                class="btn btn-sm btn-primary"
                v-if="updated == false"
                v-on:click.prevent="handleCreatedNews()"
              >
                Submit
              </button>
              <button
                type="submit"
                class="btn btn-sm btn-success"
                v-if="updated == true"
                v-on:click.prevent="handleSubmitUpdate()"
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
      fields: ["news_title", "news_descs", "news_thumb_name", "actions"],
      items: [],
      form: {
        news_title: "",
        news_desc: "",
        news_thumb: "",
      },
      submitted: false,
      updated: false,
    };
  },
  validations: {
    form: {
      news_title: { required },
      news_desc: { required },
      news_thumb: { required },
    },
  },
  computed: {
    rows() {
      return this.items.length;
    },
    news() {
      this.items = this.$store.getters.getAllNews;
    },
  },
  mounted() {
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }
    this.$store.dispatch("getNews");
  },
  methods: {
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
      this.updated = true;
      axios.get("/api/news/" + id).then((res) => {
        this.form.news_title = res.data.data.news.news_title;
        this.form.news_desc = res.data.data.news.news_desc;
        this.id = res.data.data.news.id;
        console.log(this.id);
      });
    },

    handleSubmitUpdate() {
      // var vm = this;
      // this.$v.$touch();
      // if (this.$v.$invalid) {
      //   return;
      // }
      
      let formData = new FormData();
      formData.append("news_title", this.form.news_title);
      formData.append("news_desc", this.form.news_desc);
      formData.append("news_thumb", this.form.news_thumb);

      // console.log("X");
      axios.put("/api/news/" + this.id, this.form)
      .then((res) => {
        console.log(res);
        Vue.swal({
          icon: "success",
          title: "Successfully Updated!",
        });
        this.clearData();
        this.$store.dispatch("getNews");
      })
      .catch(function(error) {
        Vue.swal({
          icon: "error",
          title: "Failed to Update!"
        });
        console.log(error);
      });
    },

    clearData() {
      this.submitted = false;
      this.updated = false;
      this.form.news_title = "";
      this.form.news_desc = "";
      this.form.news_thumb = "";
      this.$refs.file.value = null;
      this.id = "";
    },
  },
};
</script>

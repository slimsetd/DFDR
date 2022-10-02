<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Footer image</h1>
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
              <template #cell(content)="data">
                <div v-html="data.item.content"></div>
              </template>
              <template #cell(path)="data">
                <div>
                  <img
                    :src="data.item.type == 1 ? getPath(data.item.path) : getThumb(data.item.path)"
                    width="190"
                    height="100"
                  />
                 
                </div>
              </template>
              <template v-slot:cell(actions)="data">
                <b-button
                  v-b-modal.modal-1
                  variant="success"
                  class="btn-sm"
                  v-b-tooltip.hover
                  title="Detail"
                  v-on:click="detailImage(data.item.id)"
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
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
         
            <form>
              <div class="form-group">
                <label for="form_content">Content</label>
                <vue-editor v-model="form.content" />
                <small
                  id="descError"
                  class="form-text text-muted"
                  v-if="submitted && !$v.form.content.required"
                  ><i class="fa fa-info-circle text-xs"></i>&nbsp; Content is
                  required</small
                >
              </div>
                
              <div class="form-group">

                <label for="photo">Preview</label>
                <div v-if="form.path != null">
                  <div v-if="!newImage && updated">
                    <img :src="getPath(form.path)" width="190" height="100" />
                  </div>
                  <div v-else>
                    <img :src="form.blob" width="190" height="100" />
                  </div>
                </div>
              <div >
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
                  v-if="submitted && !$v.form.path.required"
                  ><i class="fa fa-info-circle text-xs"></i>&nbsp; Slider image
                  is required</small
                >
              </div>
             
              </div>
              <button
                type="submit"
                class="btn btn-sm btn-primary"
                v-if="updated == false"
                v-on:click.prevent="handleCreated()"
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
      youtubeUrl: null,
      yt_video: false,
      id: "",
      filter: "",
      perPage: 10,
      currentPage: 1,
      newImage: false,
      fields: [
        {
          key: "content",
          label: "Description",
        },
        {
          key: "path",
          label: "Image",
        },
        {
          key: "actions",
          // label: "Image",
        },
      ],
      items: [],
      form: {
        path: null,
        content: "",
      },
      submitted: false,
      updated: false,
    };
  },
  validations: {
    form: {
      path: { required },
      content: { required },
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
    this.getImages();
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }
    this.$store.dispatch("getNews");
  },
  methods: {
    getThumb(url, size) {
       let video, results;
        if (url === null) {
            return '';
        }
        size    = (size === null) ? 'big' : size;
        results = url.match('[\\?&]v=([^&#]*)');
        video   = (results === null) ? url : results[1];

        if (size === 'small') {
            return 'http://img.youtube.com/vi/' + video + '/2.jpg';
        }
        return 'http://img.youtube.com/vi/' + video + '/0.jpg';
    },
    getPath(link) {
      var filename = link.substring(link.lastIndexOf("/") + 1);
      let file_path = "/storage/uploads/file_upload/" + filename;
      return file_path;
    },
    getImages() {
      axios.get("/api/template/footer-image").then((res) => {
        this.items = res.data.data;
      });
    },
    handleUploadPhoto() {
      const file = this.$refs.file.files[0];
      // this.newImage = true;

      if (this.updated == true) {
        if (file) {
          this.newImage = true;
          this.form.path = file;
          // this.form.path = URL.createObjectURL(file);
          this.form.blob = URL.createObjectURL(file);
          URL.revokeObjectURL(file); // free memory
        }
      } else {
        this.form.path = file;
        this.form.blob = URL.createObjectURL(file);
        URL.revokeObjectURL(file); // free memory
      }
    },
    handleCreated() {
     
      this.submitted = true;
     

      let formData = new FormData();
      formData.append("type" ,1),
      formData.append("content", this.form.content);
      formData.append("path", this.form.path);
      // formData.append("news_thumb", this.form.news_thumb);
      axios.post("/api/template/footer-images", formData).then((res) => {
        console.log(res);
        Vue.swal({
          icon: "success",
          title: "Successfully Added!",
        });
        this.getImages();
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
          axios.delete("/api/template/footer-images/" + id).then((res) => {
            // console.log("bisa");
            Vue.swal({
              icon: "success",
              title: "Successfully Deleted!",
            });
            this.getImages()
          });
        }
      });
    },

    detailImage(id) {
      this.updated = true;
      this.newImage = false;
      axios.get("/api/template/footer-image/" + id).then((res) => {
        this.yt_video = res.data.data.type == 1 ? true : false;
        this.form.path = res.data.data.path;
        this.form.content = res.data.data.content;
        this.id = res.data.data.id;
      });
    },

    handleSubmitUpdate() {
      // var vm = this;
      // this.$v.$touch();
      // if (this.$v.$invalid) {
      //   return;
      // }

   let formData = new FormData();
   formData.append("id", this.id);


 
     formData.append("type" , 1),
    
     
   
      formData.append("content", this.form.content);
      formData.append("path", this.newImage == false ? '':this.form.path);
   
      // formData.append("news_thumb", this.form.news_thumb);
      axios.post("/api/template/footer-images/update", formData).then((res) => {
        console.log(res);
        Vue.swal({
          icon: "success",
          title: "Successfully Added!",
        });
        this.getImages();
        this.clearData();
      });
    },

    clearData() {
      this.submitted = false;
      this.updated = false;

      this.form.path = null;
      this.form.content = "";
      this.$refs.file.value = null;
      this.id = "";
    },
  },
};
</script>

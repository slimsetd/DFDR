<template>
  <div>
    <div>
      <carousel :per-page="1" :navigationEnabled="true">
        <!-- <template v-for="(image) in images"> -->
        <!-- <slide>
       <div>
  <b-img src="http://dfdr.test/storage/uploads/file_upload/des3.png" fluid alt="Responsive image"></b-img>
</div>
    </slide>
       <slide>
        testing 2
    </slide> -->
        <template v-for="(image, i) in images">
          <slide :key="i">
            <div v-if="image.type == 1">
              <b-img
                :src="getPath(image.path)"
                fluid
                alt="Responsive image"
              ></b-img>
            </div>
            <div v-else>
              <div class="embed-responsive embed-responsive-16by9">
                <iframe
                  class="embed-responsive-item"
                  :src="toEmbed(image.path)"
                  allowfullscreen
                ></iframe>
              </div>
            </div>
          </slide>
        </template>

        <!-- </template> -->
      </carousel>
    </div>

    <!-- section jumbotron -->
    <div class="jumbotron">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form v-on:submit.prevent="onSearch()">
                  <div class="container row mt-3">
                    <div class="col-md-10 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control form-control-lg"
                          id="search"
                          v-model="form.search_key"
                          placeholder="Search Title Submission .."
                        />
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                      <button
                        type="submit"
                        class="btn btn-primary btn-block bg-blue btn-lg"
                        v-on:click.prevent="onSearch()"
                      >
                        <!-- <i class="material-icons text-sm">search</i> -->
                        <i class="fa fa-search"></i>
                      </button>
                    </div>

                    <div class="col-md-3">
                      <div>
                        <h5>
                          <i
                            class="fa fa-angle-double-down"
                            style="font-size: 15px"
                          ></i
                          >&nbsp; <strong>Collections</strong>
                        </h5>
                        <ul style="list-style-type: circle" class="mt-2">
                          <!-- <li v-for="(cat, c) in categories" :key="c">
                            <p
                              class="cat"
                              style="cursor: pointer"
                              v-on:click.prevent="
                                onCategorySelect(cat.id, cat.category_name)
                              "
                            >
                              {{ cat.category_name }}
                            </p>
                          </li> -->
                          <li>
                            <p
                              class="cat"
                              style="cursor: pointer"
                              v-on:click.prevent="onCollections(3)"
                            >
                              Conference
                            </p>
                          </li>
                          <li>
                            <p
                              class="cat"
                              style="cursor: pointer"
                              v-on:click.prevent="onCollections(10)"
                            >
                              Bachelor
                            </p>
                          </li>
                          <li>
                            <p
                              class="cat"
                              style="cursor: pointer"
                              v-on:click.prevent="onCollections(11)"
                            >
                              Thesis Master
                            </p>
                          </li>
                          <li>
                            <p
                              class="cat"
                              style="cursor: pointer"
                              v-on:click.prevent="onCollections(12)"
                            >
                              Dissertation
                            </p>
                          </li>
                          <li>
                            <p
                              class="cat"
                              style="cursor: pointer"
                              v-on:click.prevent="onCollections(13)"
                            >
                              Material Review
                            </p>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div>
                        <h5>
                          <i
                            class="fa fa-angle-double-down"
                            style="font-size: 15px"
                          ></i
                          >&nbsp; <strong>Contributors</strong>
                        </h5>
                        <ul style="list-style-type: circle" class="mt-2">
                          <li v-for="(cat, c) in creators.slice(0, 5)" :key="c">
                            <p
                              class="cat"
                              style="cursor: pointer"
                              v-on:click.prevent="onContributors(cat.creator)"
                            >
                              {{ cat.creator }}
                            </p>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div>
                        <h5>
                          <i
                            class="fa fa-angle-double-down"
                            style="font-size: 15px"
                          ></i
                          >&nbsp; <strong>Lates</strong>
                        </h5>
                        <ul style="list-style-type: circle" class="mt-2">
                          <li>
                            <p
                              class="cat"
                              style="cursor: pointer"
                              v-on:click.prevent="onThisMonth()"
                            >
                              Newest Items Added
                            </p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row" style="margin-top: 10px">
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mt-2">
                <div class="card p-2">
                  <div class="card-body">
                    <h5 class="text-center">Submit Content</h5>
                    <div class="row">
                      <div class="col col-md-12 mt-2">
                        <router-link
                          :to="{ name: 'Login' }"
                          class="
                            btn btn-primary btn-sm btn-block
                            margin-top
                            bg-blue
                          "
                          >Login</router-link
                        >
                      </div>
                      <!-- <div class="col col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <button
                          class="btn btn-primary btn-block margin-top bg-blue"
                        >
                          Learn More
                        </button>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mt-2">
                <div class="card p-2">
                  <div class="card-body">
                    <h5 class="text-center">Registration</h5>
                    <div class="row">
                      <div class="col-md-12 mt-2">
                        <router-link
                          :to="{ name: 'Register' }"
                          class="btn btn-primary btn-sm btn-block bg-blue"
                          >Register</router-link
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mt-2">
                <div class="card p-2">
                  <div class="card-body">
                    <h5 class="text-center">About Digital Repository</h5>
                    <div class="row">
                      <div class="col-md-12 mt-2">
                        <router-link
                          :to="{ name: 'About' }"
                          class="btn btn-primary btn-sm btn-block bg-blue"
                          >Learn More</router-link
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- section news -->
    <div class="container-fluid mt-4 mb-4">
      <div class="row">
        <div class="col-md-3 mt-2">
          <div class="card p-1">
            <div class="card-body">
              <h4 class="text-center">What Is <b v-html="title">?</b></h4>
              <p class="text-justify mt-2" v-html="description">
                &nbsp;&nbsp;&nbsp;&nbsp;<b v-html="title"></b>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="text-center" v-if="loading">
            <loading-component></loading-component>
          </div>
          <div v-if="!loading">
            <div class="card mt-2" v-for="(feed, n) in news" :key="n">
              <div class="card-body">
                <div class="row p-2">
                  <div class="col-md-9 p-4">
                    <h4>
                      <router-link
                        :to="{
                          name: 'Detailnews',
                          params: { id: feed.id },
                        }"
                        >{{ feed.news_title }}</router-link
                      >
                    </h4>
                    <div v-html="feed.news_desc"></div>
                  </div>
                  <div class="col-md-3 d-none d-sm-none d-md-block">
                    <img
                      :src="
                        '/storage/uploads/news_thumb/' + feed.news_thumb_name
                      "
                      alt=""
                      class="img-thumbnail float-right"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.card {
  box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
  border-radius: 1rem !important;
}

img,
video,
object,
embed {
  max-width: 100%;
  height: auto;
  overflow: hidden !important;
}

.btn-primary {
  border-color: transparent;
}
@media only screen and (max-width: 600px) {
  .example {
    margin-top: 30px;
  }
}
</style>
<script>
import { Carousel, Slide } from "vue-carousel";
export default {
  components: {
    Carousel,
    Slide,
  },
  data() {
    return {
      showVideo: false,
      isInstalled : false,
      videoId: null,
      images: [],
      news: [],
      title: null,
      embed: null,
      description: null,
      loading: false,
      slide: 0,
      sliding: null,
      install: true,
      form: {
        search_key: "",
      },
    };
  },
  computed: {
    categories() {
      return this.$store.getters.getAllCreator;
    },
    creators() {
      return this.$store.getters.getAllCreator;
    },
  },
  mounted() {
    this.preUsed();
    this.$store.dispatch("getCreator");
    this.getImages();
    this.preAdmin();
    // this.$store.dispatch("getCategory");
    this.getNews();
    this.getDescription();
    this.getHeader();
    // this.getYoutube("https://www.youtube.com/watch?v=qXlZVDA_S_s");

    // console.log(this.creators);

    // console.log("homepage");
  },
  methods: {
    toEmbed(url) {
      var str = url;
      var res = str.split("=");
      var embeddedUrl = "https://www.youtube.com/embed/" + res[1];
      // document.getElementById("demo").innerHTML = res;
      this.embed = embeddedUrl;
      return embeddedUrl;
    },
    getYoutube(url) {
      return this.$youtube.getIdFromURL(url);
      this.startTime = this.$youtube.getTimeFromURL(url);
    },
    getPath(link) {
      var filename = link.substring(link.lastIndexOf("/") + 1);
      let file_path = "/storage/uploads/file_upload/" + filename;
      return file_path;
    },
    getImages() {
      axios
        .get("/api/template/images")
        .then((response) => {
          this.images = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    onSlideStart(slide) {
      this.sliding = true;
    },
    onSlideEnd(slide) {
      this.sliding = false;
    },
    getDescription() {
      axios.get("/api/template/home/2").then((response) => {
        this.description = response.data.data.content;
      });
    },
    getHeader() {
      axios.get("/api/template/home/1").then((response) => {
        this.title = response.data.data.content;
      });
    },

    preUsed() {
      // var val;
      
      axios.get("/api/preUsed")
      .then((res) => {
        
        console.log(res.data.data);
        this.install = res.data.data.file;

        if (!this.install) {
          window.location.href = '/install';
          // this.$router.push("/install");
        }
      });
      
      // return val;
    },

     preAdmin() {
      axios.get("/api/preAdmin")
      .then((res) => {
        // console.log(res.data.data);
        var count = res.data.data.data;

        if (count == 0) {
          this.$router.push("/adm-config");
        }
      });
    },

    getNews() {
      this.loading = true;
      axios.get("/api/news").then((res) => {
        this.news = res.data.data.news;
        this.loading = false;
        // console.log(res.data);
      });
    },

    onSearch() {
      this.$router.push({
        name: "SubmissionFilter",
        params: { keySearch: this.form.search_key, part: "Search" },
      });
    },

    onCollections(val) {
      this.$router.push({
        name: "SubmissionFilter",
        params: { keySearch: val, part: "Collection" },
      });
    },

    onThisMonth() {
      this.$router.push({
        name: "SubmissionFilter",
        params: { keySearch: "", part: "This_Month" },
      });
    },

    onContributors(val) {
      this.$router.push({
        name: "SubmissionFilter",
        params: { keySearch: val, part: "Creator" },
      });
    },
  },
};
</script>
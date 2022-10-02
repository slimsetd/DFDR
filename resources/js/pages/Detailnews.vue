<template>
  <div>
    <div class="container-fluid mt-4">
      <div class="card p-4">
        <div class="card-body">
          <div class="text-center" v-if="loading">
            <loading-component></loading-component>
          </div>
          <div class="row" v-if="!loading">
            <div class="col">
              <h2 class="text-center mb-4">{{ news.news_title }}</h2>
              <img
                :src="'/storage/uploads/news_thumb/' + news.news_thumb_name"
                alt=""
                class="img-thumbnail"
              />
              <div class="mt-4" v-html="news.news_desc"></div>
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
</style>

<script>
export default {
  data() {
    return {
      news: {},
      loading: false,
    };
  },
  mounted() {
    var id = this.$route.params.id;
    if (id) {
      this.getDetailNews(id);
    }
    console.log("detailnews");
  },
  methods: {
    getDetailNews(id) {
      this.loading = true;
      axios.get("/api/news/" + id).then((res) => {
        this.news = res.data.data.news;
        // console.log(res);
        this.loading = false;
        console.log(this.news);
      });
    },
  },
};
</script>

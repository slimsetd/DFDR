<template>
  <div class="mt-4">
    <div class="row justify-content-center">
      <div class="col-md-3 col-sm-12 col-xs-12">
        <sidesubmission-component></sidesubmission-component>
      </div>
      <div class="col-md-9 col-sm-12 col-xs-12">
        <div>
          <h4>All Category</h4>
          <ul>
            <li v-for="(cat, c) in countCategory" :key="c">
              <p class="cat">
                <a
                  v-on:click="onSearchByCategory(cat.category)"
                  style="cursor: pointer"
                >
                  {{ cat.category_name.category_name }}</a
                >
                [ {{ cat.total }} ]
              </p>
            </li>
          </ul>
        </div>
        <div class="text-center" v-if="loading">
          <loading-component></loading-component>
        </div>
        <div v-if="!loading">
          <hr />
          <div v-for="(sub, s) in submissions" :key="s">
            <div class="row">
              <div class="col-md-12">
                <img
                  class="img-fluid mb-2 float-left"
                  src="/admin-template/img/logo.png"
                  width="70"
                  style="margin-right: 20px"
                />
                <p class="title-text">
                  <router-link
                    :to="{
                      name: 'DetailSubmission',
                      params: { id: sub.id },
                    }"
                    >{{ sub.title }}</router-link
                  >
                </p>
                <p
                  class="sub-text cat"
                  style="cursor: pointer"
                  v-on:click="onSearchByCategory(sub.category)"
                >
                  {{ sub.category_name }}
                </p>
                <p class="sub-text">
                  <i
                    v-for="(subcreator, sc) in sub.upload_form_creator"
                    :key="sc"
                    >{{ subcreator.creator }},&nbsp;
                  </i>
                  - {{ sub.date }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["id"],
  data() {
    return {
      submissions: [],
      loading: false,
      category: [],
      clickedCategory: false,
      countCategory: [],
    };
  },
  computed: {
    categories() {
      return this.$store.getters.getAllCategories;
    },
  },
  mounted() {
    this.getCategoryCount();
    this.$store.dispatch("getCategory");
    console.log(this.category);
    this.getSubmissions();
  },

  methods: {
    getSubmissions() {
      this.loading = true;
      axios.get("/api/upload-form/search/status/Approved").then((res) => {
        this.submissions = res.data.data.form;
        this.loading = false;
        // console.log(res);
        console.log(this.submissions);
      });
    },

    getCategoryCount() {
      axios.get("/api/group/count/deposit").then((res) => {
        this.countCategory = res.data.data.all_list;
        console.log(this.countCategory);
      });
    },

    onSearchByCategory(id) {
      this.clickedCategory = true;
      this.getSubmissionCategory(id);
      console.log(id);
      console.log(this.clickedCategory);
    },

    getSubmissionCategory(id) {
      this.loading = true;
      axios.get("/api/upload-form/search/category/" + id).then((res) => {
        this.submissions = res.data.data.form;
        this.loading = false;
        // console.log(res);
        console.log(this.submissions);
      });
    },
  },
};
</script>

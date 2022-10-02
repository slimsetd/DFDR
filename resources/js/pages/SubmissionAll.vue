<template>
  <div class="container-fluid mt-4">
    <div class="row justify-content-center">
      <div class="col-md-3 col-sm-12 col-xs-12">
        <sidesubmission-component></sidesubmission-component>
      </div>
      <div class="col-md-9 col-sm-12 col-xs-12">
        <h4>All Deposit</h4>
        <form v-on:submit.prevent="onSearch()">
          <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control form-control-lg"
                  id="search"
                  v-model="form.search_key"
                  placeholder="Enter any keywords ..."
                />
              </div>
            </div>
            <div class="col-md-2">
              <button
                type="submit"
                class="btn btn-primary btn-block bg-blue btn-lg"
                v-on:click.prevent="onSearch()"
              >
                <!-- <span class="material-icons">search</span> -->
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        <div class="row">
          <div class="col-md-8">
            <p>submission found: {{ submissionCounting }} items</p>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select
                class="form-control form-control-sm"
                id="department"
                aria-describedby="departmentError"
                v-on:change="onSorting($event)"
              >
                <option value="ASC">Sort By A - Z</option>
                <option value="DESC">Sort By Z - A</option>
              </select>
              <small
                id="departmentError"
                class="form-text text-muted"
                v-if="submitted && !$v.form.department.required"
                >Harap pilih salah satu departemen</small
              >
            </div>
          </div>
        </div>
        <div class="text-center" v-if="loading">
          <loading-component></loading-component>
        </div>
        <div v-if="!loading">
          <div v-show="submissions.length == 0">
            <p class="text-center">Submission not found</p>
          </div>
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

<style>
p {
  margin: 0;
  padding: 0;
}
.title-text {
  font-size: 14px;
}
.sub-text {
  font-size: 14px;
}
.cat {
  color: #96bb7c;
  /* cursor: pointer; */
}
</style>

<script>
export default {
  data() {
    return {
      submitted: false,
      submissionCounting: "",
      submissions: [],
      form: {
        search_key: "",
      },
      loading: true,
    };
  },
  mounted() {
    // this.getSubmissions();
    this.form.search_key = this.$route.params.keySearch;
    if (this.$route.params.keySearch) {
      this.onSearch();
    } else {
      this.getSubmissions("ASC");
    }
    console.log(this.$route.params.keySearch);
  },

  methods: {
    onSorting(event) {
      console.log(event.target.value);
      this.getSubmissions(event.target.value);
    },

    getSubmissions(sort) {
      this.loading = true;
      axios
        .get("/api/upload-form/search/status/Approved/" + sort)
        .then((res) => {
          this.submissions = res.data.data.form;
          this.submissionCounting = this.submissions.length;
          this.loading = false;
        });
    },

    onSearch() {
      console.log(this.form.search_key);
      this.loading = true;
      if (this.form.search_key == "") {
        this.getSubmissions("ASC");
      } else {
        console.log(this.form.search_key);
        axios
          .get("/api/upload-form/search/global/" + this.form.search_key)
          .then((res) => {
            this.loading = false;
            this.submissions = res.data.data.form;
            this.submissionCounting = this.submissions.length;
          });
      }
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
        this.submissionCounting = this.submissions.length;
        this.loading = false;
        // console.log(res);
        console.log(this.submissions);
      });
    },
  },
};
</script>

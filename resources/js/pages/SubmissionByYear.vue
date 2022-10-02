<template>
  <div class="mt-4">
    <div class="row justify-content-center">
      <div class="col-md-3 col-sm-12 col-xs-12">
        <sidesubmission-component></sidesubmission-component>
      </div>
      <div class="col-md-9 col-sm-12 col-xs-12">
        <h4>Submission by Year</h4>
        <form v-on:submit.prevent="onSearch()">
          <div class=" row">
            <div class="col-md-10">
              <!-- <div class="form-group">
                  <input
                    type="text"
                    class="form-control form-control-lg"
                    id="search"
                    v-model="form.year"
                    placeholder="Masukkan nama creator disini ..."
                  />
                </div> -->
              <div class="form-group">
                <select
                  class="form-control form-control-lg"
                  id="year"
                  v-model="form.year"
                  aria-describedby="yearError"
                  v-on:change="onSearch($event)"
                >
                  <option selected disabled> Select Year</option>
                  <option
                    v-for="(year, y) in years"
                    :key="y"
                    :value="year.id"
                    >{{ year.year }}</option
                  >
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <button
                type="submit"
                class="btn btn-primary btn-block bg-blue"
                v-on:click.prevent="onSearch()"
              >
                <span class="material-icons">search</span>
              </button>
            </div>
          </div>
        </form>
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

<script>
export default {
  data() {
    return {
      submissions: [],
      loading: true,
      form: {
        year: "",
      },
    };
  },
  computed: {
    years() {
      return this.$store.getters.getAllYears;
    },
  },
  mounted() {
    this.getSubmissions();
    this.$store.dispatch("getYears");
  },

  methods: {
    getSubmissions() {
      axios.get("/api/upload-form/search/status/Approved").then((res) => {
        this.submissions = res.data.data.form;
        this.loading = false;
        // console.log(res);
        console.log(this.submissions);
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

    onSearch() {
      console.log(this.form.year);
      this.loading = true;
      if (this.form.year == "") {
        this.getSubmissions();
      } else {
        console.log(this.form.year);
        axios
          .get("/api/upload-form/search/year/" + this.form.year)
          .then((res) => {
            this.loading = false;
            this.submissions = res.data.data.form;
            console.log(res);
          });
      }
    },
  },
};
</script>

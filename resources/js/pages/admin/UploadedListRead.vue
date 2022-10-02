<template>
  <div class="container-fluid mt-4 mb-4">
    <div class="row justify-content-center">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card p-4">
          <div class="card-body">
            <h4>Open <b> Collections</b></h4>
            <form v-on:submit.prevent="onSearch()">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control form-control-lg"
                      id="search"
                      v-model="form.search_key"
                      placeholder="Enter Title Submission ..."
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <button
                    type="submit"
                    class="btn btn-primary btn-block bg-blue btn-lg"
                    v-on:click.prevent="onSearch()"
                  >
                    <i class="fa fa-search"></i>
                    <!-- <span class="material-icons">search</span> -->
                  </button>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-md-7 col-sm-7 col-xs-7">
                <p>Submission found : {{ submissionCounting }} items</p>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
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

            <!-- type 1 -->
            <!-- <div class="row mt-4">
              <div class="col-md-4">
                <div>
                  <h5>Collections:</h5>
                  <ul style="list-style-type: circle" class="mt-2">
                    <li v-for="(cat, c) in categories" :key="c">
                      <p
                        class="cat"
                        style="cursor: pointer"
                        v-on:click.prevent="
                          onCategorySelect(cat.id, cat.category_name)
                        "
                      >
                        {{ cat.category_name }}
                      </p>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div>
                  <h5>Date Range</h5>
                  <form>
                    <div class="row mt-2">
                      <div class="col">
                        <div class="form-group">
                          <input
                            type="date"
                            name=""
                            id=""
                            v-model="form.start_date"
                            class="form-control font-date"
                          />
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <input
                            type="date"
                            name=""
                            id=""
                            v-model="form.end_date"
                            class="form-control"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <button
                          class="btn btn-primary btn-sm btn-block"
                          v-on:click.prevent="onDateRange()"
                        >
                          Apply
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-4">
                <div>
                  <h5>Type :</h5>
                  <ul style="list-style-type: circle" class="mt-2">
                    <li v-for="(typ, t) in type" :key="t">
                      <p
                        class="cat"
                        style="cursor: pointer"
                        v-on:click.prevent="onTypeSelected(typ.type)"
                      >
                        {{ typ.type }}
                      </p>
                    </li>
                  </ul>
                </div>
                <hr />
                <div>
                  <h5>Subject :</h5>
                  <ul style="list-style-type: circle" class="mt-2">
                    <li v-for="(sub, c) in subject" :key="c">
                      <p
                        class="cat"
                        style="cursor: pointer"
                        v-on:click.prevent="onSubjectClicked(sub.subject)"
                      >
                        {{ sub.subject }}
                      </p>
                    </li>
                  </ul>
                </div>
              </div>
            </div> -->

            <!-- type 2 -->
            <!-- <div class="row mt-4">
              <div class="col-md-4">
                <div>
                  <h5>Collections:</h5>
                  <ul style="list-style-type: circle" class="mt-2">
                    <li v-for="(cat, c) in categories" :key="c">
                      <p
                        class="cat"
                        style="cursor: pointer"
                        v-on:click.prevent="
                          onCategorySelect(cat.id, cat.category_name)
                        "
                      >
                        {{ cat.category_name }}
                      </p>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div>
                  <h5>Date Range</h5>
                  <form>
                    <div class="row mt-2">
                      <div class="col">
                        <div class="form-group">
                          <input
                            type="date"
                            name=""
                            id=""
                            v-model="form.start_date"
                            class="form-control font-date"
                          />
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <input
                            type="date"
                            name=""
                            id=""
                            v-model="form.end_date"
                            class="form-control"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <button
                          class="btn btn-primary btn-sm btn-block"
                          v-on:click.prevent="onDateRange()"
                        >
                          Apply
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-4">
                <div>
                  <h5>Type :</h5>
                  <ul style="list-style-type: circle" class="mt-2">
                    <li v-for="(typ, t) in type" :key="t">
                      <p
                        class="cat"
                        style="cursor: pointer"
                        v-on:click.prevent="onTypeSelected(typ.type)"
                      >
                        {{ typ.type }}
                      </p>
                    </li>
                  </ul>
                </div>
                <hr />
                <div>
                  <h5>Subject :</h5>
                  <ul style="list-style-type: circle" class="mt-2">
                    <li v-for="(sub, c) in subject" :key="c">
                      <p
                        class="cat"
                        style="cursor: pointer"
                        v-on:click.prevent="onSubjectClicked(sub.subject)"
                      >
                        {{ sub.subject }}
                      </p>
                    </li>
                  </ul>
                </div>
              </div>
            </div> -->

          </div>
        </div>
        
        <div>
          <div>
            <div class="row mt-4">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                  <div class="card-body p-4">
                    <h4 class="text-center mb-4">Filter Result</h4>
                    <div>
                      <nav class="navbar-light bg-light mb-2" 
                           style="padding-left:15px; padding-right:15px; padding-top:5px;">
                        <div class="row">
                          <div class="col-md-12">
                            <a class="navbar-brand title-text" 
                               v-on:click.prevent="v_option = !v_option"
                               style="cursor: pointer; width:100%;">
                              &nbsp; <i class="fa fa-caret-down"></i>&nbsp; Options
                            </a>
                          </div>
                          <div class="col-md-12" v-if="v_option">
                            <hr style="margin:8px; padding:0;">
                            <ul style="list-style-type: circle" class="mt-2">
                              <li>
                                <p
                                  class="cat"
                                  style="cursor: pointer"
                                  v-on:click.prevent="onOptionSelected('Open')"
                                >
                                  Open
                                </p>
                              </li>
                              <li>
                                <p
                                  class="cat"
                                  style="cursor: pointer"
                                  v-on:click.prevent="onOptionSelected('Close')"
                                >
                                  Close
                                </p>
                              </li>
                            </ul>
                          </div>    
                        </div>
                      </nav>
                    </div>
                    <div>
                      <nav class="navbar-light bg-light mb-2" 
                           style="padding-left:15px; padding-right:15px; padding-top:5px;">
                        <div class="row">
                          <div class="col-md-12">
                            <a class="navbar-brand title-text" 
                               v-on:click.prevent="v_collections = !v_collections"
                               style="cursor: pointer; width:100%;">
                              &nbsp; <i class="fa fa-caret-down"></i>&nbsp; Collections
                            </a>
                          </div>
                          <div class="col-md-12" v-if="v_collections">
                            <hr style="margin:8px; padding:0;">
                            <ul style="list-style-type: circle" class="mt-2">
                              <li v-for="(cat, c) in categories" :key="c">
                                <p
                                  class="cat"
                                  style="cursor: pointer"
                                  v-on:click.prevent="onCategorySelect(cat.id, cat.category_name)"
                                >
                                  {{ cat.category_name }}
                                </p>
                              </li>
                            </ul>
                          </div>    
                        </div>
                      </nav>
                    </div>
                    <div>
                      <nav class="navbar-light bg-light mb-2"
                           style="padding-left:15px; padding-right:15px; padding-top:5px;">
                        <div class="row">
                          <div class="col-md-12">
                            <a class="navbar-brand title-text" 
                               v-on:click.prevent="v_date = !v_date"
                               style="cursor: pointer; width:100%;">
                              &nbsp; <i class="fa fa-caret-down"></i>&nbsp; Date Range
                            </a>
                          </div>
                          <div class="col-md-12 mb-4" v-if="v_date">
                            <hr style="margin:8px; padding:0;">
                            <form>
                              <div class="row mt-3">
                                <div class="col">
                                  <div class="form-group">
                                    <!-- <label for="">Start Date</label> -->
                                    <input
                                      type="date"
                                      name=""
                                      id=""
                                      v-model="form.start_date"
                                      class="form-control font-date"
                                    />
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                    <!-- <label for="">End Date</label> -->
                                    <input
                                      type="date"
                                      name=""
                                      id=""
                                      v-model="form.end_date"
                                      class="form-control"
                                    />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <button
                                    class="btn btn-primary btn-sm btn-block"
                                    v-on:click.prevent="onDateRange()"
                                  >
                                    Apply
                                  </button>
                                </div>
                              </div>
                            </form>
                          </div>    
                        </div>
                      </nav>
                    </div>
                    <div>
                      <nav class="navbar-light bg-light mb-2" 
                           style="padding-left:15px; padding-right:15px; padding-top:5px;">
                        <div class="row">
                          <div class="col-md-12">
                            <a class="navbar-brand title-text" 
                               v-on:click.prevent="v_creator = !v_creator"
                               style="cursor: pointer; width:100%;">
                              &nbsp; <i class="fa fa-caret-down"></i>&nbsp; Creators
                            </a>
                          </div>
                          <div class="col-md-12" v-if="v_creator">
                            <hr style="margin:8px; padding:0;">
                            <ul style="list-style-type: circle" class="mt-2">
                              <li v-for="(cat, c) in creators" :key="c">
                                <p
                                  class="cat"
                                  style="cursor: pointer"
                                  v-on:click.prevent="onCreatorSelected(cat.creator)"
                                >
                                  {{ cat.creator }}
                                </p>
                              </li>
                            </ul>
                          </div>    
                        </div>
                      </nav>
                    </div>
                    <div>
                      <nav class="navbar-light bg-light mb-2" 
                           style="padding-left:15px; padding-right:15px; padding-top:5px;">
                        <div class="row">
                          <div class="col-md-12">
                            <a class="navbar-brand title-text" 
                               v-on:click.prevent="v_subject = !v_subject"
                               style="cursor: pointer; width:100%;">
                              &nbsp; <i class="fa fa-caret-down"></i>&nbsp; Subject
                            </a>
                          </div>
                          <div class="col-md-12" v-if="v_subject">
                            <hr style="margin:8px; padding:0;">
                            <ul style="list-style-type: circle" class="mt-2">
                              <li v-for="(sub, c) in subject" :key="c">
                                <p
                                  class="cat"
                                  style="cursor: pointer"
                                  v-on:click.prevent="onSubjectClicked(sub.subject)"
                                >
                                  {{ sub.subject }}
                                </p>
                              </li>
                            </ul>
                          </div>    
                        </div>
                      </nav>
                    </div>
                    <div>
                      <nav class="navbar-light bg-light mb-2" 
                           style="padding-left:15px; padding-right:15px; padding-top:5px;">
                        <div class="row">
                          <div class="col-md-12">
                            <a class="navbar-brand title-text" 
                               v-on:click.prevent="v_type = !v_type"
                               style="cursor: pointer; width:100%;">
                              &nbsp; <i class="fa fa-caret-down"></i>&nbsp; Type
                            </a>
                          </div>
                          <div class="col-md-12" v-if="v_type">
                            <hr style="margin:8px; padding:0;">
                            <ul style="list-style-type: circle" class="mt-2">
                              <li v-for="(typ, t) in type" :key="t">
                                <p
                                  class="cat"
                                  style="cursor: pointer"
                                  v-on:click.prevent="onTypeSelected(typ.type)"
                                >
                                  {{ typ.type }}
                                </p>
                              </li>
                            </ul>
                          </div>    
                        </div>
                      </nav>
                    </div>
                    
                  </div>
                </div>
              </div>

              <div class="col-md-8 text-center mt-4" v-if="loading">
                <loading-component></loading-component>
              </div>
              <div class="col-md-8 col-sm-12 col-xs-12" v-if="!loading">
                <div class="card">
                  <div class="card-body p-3">
                    <div v-show="submissions.length == 0">
                      <p class="text-center">Submission not found</p>
                    </div>
                    <div class="row">
                      <div
                        class="col-md-12 p-2"
                        v-for="(sub, s) in submissions"
                        :key="s"
                      >
                        <img
                          class="img-fluid mb-2 float-left"
                          src="/admin-template/img/logo.png"
                          width="70"
                          style="margin-right: 20px"
                        />
                        <p class="title-text">
                          <router-link
                            :to="{
                              name: 'UploadedFileDetail',
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
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
p {
  margin: 0;
  padding: 0;
}
.title-text {
  font-size: 18px;
  font-weight: bold;
}
.sub-text {
  font-size: 14px;
}
.cat {
  color: #96bb7c;
  /* cursor: pointer; */
}

.card {
  box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
  border-radius: 1rem !important;
}
</style>

<script>
export default {
  data() {
    return {
      v_collections: false,
      v_date: false,
      v_creator: false,
      v_subject: false,
      v_type: false,
      v_option: false,
      subject: [],
      type: [],
      submitted: false,
      submissionCounting: "",
      submissions: [],
      selectCategory: null,
      form: {
        search_key: "",
        category: "",
        type: "",
        subject: "",
        start_date: "",
        end_date: "",
      },
      loading: true,
    };
  },
  computed: {
    categories() {
      return this.$store.getters.getAllCategories;
    },
    creators() {
      return this.$store.getters.getAllCreator;
    },
  },
  mounted() {
    this.form.category = this.$route.params.category;
    this.form.search_key = this.$route.params.keySearch;

    if (this.$route.params.part == 'Search') 
      this.onSearch();
    else if (this.$route.params.part == 'Collection')
      this.onCategorySelect(this.$route.params.keySearch, '');
    else if (this.$route.params.part == 'This_Month')
      this.onThisMonth();
    else if (this.$route.params.part == 'Creator')
      this.onCreatorSelected(this.$route.params.keySearch);
    else 
      this.getSubmissions("ASC");
    

    this.$store.dispatch("getCategory");
    this.$store.dispatch("getCreator");

    this.getSubject();
    this.getType();
  },

  methods: {
    clearFilter() {
      this.getSubmissions("ASC");
      this.form.ctegory = "";
    },

    onSorting(event) {
      console.log(event.target.value);
      this.getSubmissions(event.target.value);
    },

    onDateRange() {
      console.log(this.form);
      // this.form.subject = subject;
      this.loading = true;
      let data = {
        title: this.form.search_key,
        category: this.form.category,
        type: this.form.type,
        subject: this.form.subject,
        start_date: this.form.start_date,
        end_date: this.form.end_date,
      };
      axios.post("/api/upload-form/search/new/title", data).then((res) => {
        this.loading = false;
        this.submissions = res.data.data.form;
        this.submissionCounting = this.submissions.length;
      });
    },

    getSubject() {
      axios.get("/api/list/data/subject").then((res) => {
        this.subject = res.data.data.data;
        // console.log(this.subject);
      });
    },

    getType() {
      axios.get("/api/list/data/type").then((res) => {
        // console.log(res);
        this.type = res.data.data.data;
        // console.log(this.type);
      });
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
      // console.log(this.form.search_key);
      this.loading = true;

      if (this.form.search_key == "" || this.form.search_key == undefined) {
        this.getSubmissions("ASC");
      } else {
        let data = {
          title: this.form.search_key,
        };
        axios.post("/api/upload-form/search/new/title", data).then((res) => {
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
        console.log(this.submissions);
      });
    },

    onThisMonth() {
      this.loading = true;
      let data = {
        this_month: '',
      };
      axios
      .post("/api/upload-form/search/new/title", data)
      .then((res) => {
        // console.log(res);
        this.loading = false;
        this.submissions = res.data.data.form;
        this.submissionCounting = this.submissions.length;
      });
    },

    onCategorySelect(id, name) {
      this.selectCategory = name;
      this.form.category = id;
      this.loading = true;
      let data = {
        
        category: id,
      };
      axios.post("/api/upload-form/search/new/title", data).then((res) => {
        this.loading = false;
        this.submissions = res.data.data.form;
        this.submissionCounting = this.submissions.length;
      });
    },

    onOptionSelected(type) {
      this.loading = true;
      let data = {
        right_management: type,
      };
      axios
      .post("/api/upload-form/search/new/title", data)
      .then((res) => {
        // console.log(res);
        this.loading = false;
        this.submissions = res.data.data.form;
        this.submissionCounting = this.submissions.length;
      });
    },

    onCreatorSelected(type) {
      // this.form.type = type;
      this.loading = true;
      let data = {
        creator: type,
      };
      axios
      .post("/api/upload-form/search/new/title", data)
      .then((res) => {
        // console.log(res);
        this.loading = false;
        this.submissions = res.data.data.form;
        this.submissionCounting = this.submissions.length;
      });
    },

    onTypeSelected(type) {
      this.form.type = type;
      this.loading = true;
      let data = {
        title: this.form.search_key,
        category: this.form.category,
        type: type,
      };
      axios.post("/api/upload-form/search/new/title", data).then((res) => {
        this.loading = false;
        this.submissions = res.data.data.form;
        this.submissionCounting = this.submissions.length;
      });
    },

    onSubjectClicked(subject) {
      this.form.subject = subject;
      this.loading = true;
      let data = {
        title: this.form.search_key,
        category: this.form.category,
        type: this.form.type,
        subject: subject,
      };
      axios.post("/api/upload-form/search/new/title", data).then((res) => {
        this.loading = false;
        this.submissions = res.data.data.form;
        this.submissionCounting = this.submissions.length;
      });
    },

    resetCategory() {
      this.form.category = "";
      console.log(this.form.category);
    },
  },
};
</script>

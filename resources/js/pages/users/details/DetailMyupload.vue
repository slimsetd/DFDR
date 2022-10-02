<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Detail My Upload File
        <span class="badge badge-warning" v-if="form.status == 'pending'">
          Pending
        </span>
        <span class="badge badge-success" v-if="form.status == 'Approved'">
          Approved
        </span>
        <span class="badge badge-danger" v-if="form.status == 'Reject'">
          Reject
        </span>
      </h1>
      <a
        @click="$router.go(-1)"
        class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a
      >
      <!-- <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a
      > -->
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body" v-if="loading">
            <div class="text-center">
              <loading-component></loading-component>
            </div>
          </div>
          <div class="card-body" v-if="!loading">
            <form enctype="multipart/form-data">
              <div class="">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input
                        type="text"
                        class="form-control"
                        id="title"
                        v-model="form.title"
                        required
                        readonly
                        aria-describedby="titleHelp"
                        placeholder="Enter Title"
                      />
                      <small
                        id="titleHelp"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.title.required"
                        >Title is required</small
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select
                        class="form-control"
                        id="category"
                        v-model="form.category"
                        readonly
                        aria-describedby="categoryHelp"
                      >
                        <option value="" selected disabled
                          >Select category</option
                        >
                        <option
                          v-for="(cat, c) in categories"
                          :key="c"
                          :value="cat.id"
                          >{{ cat.category_name }}</option
                        >
                      </select>
                      <small
                        id="categoryHelp"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.category.required"
                        >Category is required</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description">Description</label>
                      <vue-editor
                        v-model="form.description"
                        disabled
                        style="background-color: #eaecf4"
                      />
                      <small
                        id="descError"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.description.required"
                        >Description is required</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="publisher">Publisher</label>
                      <input
                        type="text"
                        class="form-control"
                        id="publisher"
                        readonly
                        v-model="form.publisher"
                        aria-describedby="publisherHelp"
                        placeholder="Enter publisher"
                      />
                      <small
                        id="publisherHelp"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.publisher.required"
                        >Publisher is required</small
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="date">Date</label>
                      <input
                        type="date"
                        class="form-control"
                        id="date"
                        name="date"
                        readonly
                        v-model="form.date"
                        aria-describedby="dateError"
                        placeholder="Masukkan date"
                      />
                      <small
                        id="dateError"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.date.required"
                        >Date is required</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="language">Language</label>
                      <select
                        class="form-control"
                        id="language"
                        readonly
                        v-model="form.language"
                        aria-describedby="languageError"
                      >
                        <option value="" selected disabled
                          >Select language</option
                        >
                        <option
                          v-for="(lang, d) in languages"
                          :key="d"
                          :value="lang.id"
                          >{{ lang.language_name }}</option
                        >
                      </select>
                      <small
                        id="languageError"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.language.required"
                        >Language is required</small
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="relation">Relation</label>
                      <input
                        type="text"
                        class="form-control"
                        id="relation"
                        readonly
                        v-model="form.relation"
                        aria-describedby="relationHelp"
                        placeholder="Enter relation"
                      />
                      <small
                        id="relationHelp"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.relation.required"
                        >Relation is required</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="right_management">Right Management</label>
                      <input
                        type="text"
                        class="form-control"
                        id="right_management"
                        readonly
                        v-model="form.right_management"
                        aria-describedby="right_managementHelp"
                        placeholder="Enter Right Management"
                      />
                      <small
                        id="right_managementHelp"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.right_management.required"
                        >Right management is required</small
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="creator">Creator</label>

                      <textarea
                        class="form-control"
                        id="creator"
                        v-model="form.creator"
                        rows="3"
                        readonly
                        placeholder="Enter creator"
                        aria-describedby="creatorErr"
                      ></textarea>
                      <small
                        id="creatorErr"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.creator.required"
                        >Creator is required</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="subject">Subject</label>
                      <textarea
                        class="form-control"
                        id="subject"
                        readonly
                        v-model="form.subject"
                        rows="3"
                        placeholder="Enter subject"
                        aria-describedby="subjectErr"
                      ></textarea>
                      <small
                        id="subjectErr"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.subject.required"
                        >Subject is required</small
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="type">Type</label>
                      <textarea
                        class="form-control"
                        id="type"
                        v-model="form.type"
                        rows="3"
                        readonly
                        placeholder="Enter type"
                        aria-describedby="typeErr"
                      ></textarea>
                      <small
                        id="typeErr"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.type.required"
                        >Type is required</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="format">Format</label>
                      <textarea
                        class="form-control"
                        id="format"
                        v-model="form.format"
                        rows="3"
                        readonly
                        placeholder="Enter format"
                        aria-describedby="formatErr"
                      ></textarea>
                      <small
                        id="formatErr"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.format.required"
                        >Format is required</small
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="contributor">Contributor</label>
                      <textarea
                        class="form-control"
                        id="contributor"
                        v-model="form.contributor"
                        rows="3"
                        readonly
                        placeholder="Enter contributor"
                        aria-describedby="contributorErr"
                      ></textarea>
                      <small
                        id="contributorErr"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.contributor.required"
                        >Contributor is required</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="identifier">Identifier</label>
                      <textarea
                        class="form-control"
                        id="identifier"
                        v-model="form.identifier"
                        rows="3"
                        readonly
                        placeholder="Enter identifier"
                        aria-describedby="identifierErr"
                      ></textarea>
                      <small
                        id="identifierErr"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.identifier.required"
                        >Identifier is required</small
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="source">Source</label>
                      <textarea
                        class="form-control"
                        id="source"
                        v-model="form.source"
                        rows="3"
                        readonly
                        placeholder="Enter source"
                        aria-describedby="sourceErr"
                      ></textarea>
                      <small
                        id="sourceErr"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.source.required"
                        >Source is required</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="coverage">coverage</label>
                      <textarea
                        class="form-control"
                        id="coverage"
                        v-model="form.coverage"
                        rows="3"
                        readonly
                        placeholder="Enter coverage"
                        aria-describedby="coverageErr"
                      ></textarea>
                      <small
                        id="coverageErr"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.coverage.required"
                        >coverage is required</small
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="division_information"
                        >Division Information</label
                      >
                      <textarea
                        class="form-control"
                        id="division_information"
                        v-model="form.division_information"
                        rows="3"
                        readonly
                        placeholder="Enter division information"
                        aria-describedby="division_informationErr"
                      ></textarea>
                      <small
                        id="division_informationErr"
                        class="form-text text-muted"
                        v-if="
                          submitted && !$v.form.division_information.required
                        "
                        >Division information is required</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="d-flex p-3">
                    <div v-for="(file, f) in form.file_upload" :key="f">
                      <div class="card" style="margin-left: 10px">
                        <div class="card-title">
                          <p class="text-center mt-2">
                            <i class="fas fa-file-pdf fa-5x"></i>
                          </p>
                        </div>
                        <div class="card-body">
                          <a
                            :href="
                              '/storage/uploads/file_upload/' + file.file_name
                            "
                            download
                          >
                            {{ file.file_name }}
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-md-6">
                    <div class="form-group">
                      <div class="row">
                        <div>
                        </div>
                        <div class="col-md-10">
                          <label for="upload_file">File</label>
                          <input
                            type="file"
                            ref="file"
                            multiple
                            @change="handleUploadPhoto()"
                            class="form-control-file"
                            id="photo"
                          />

                          <small
                            id="upload_fileHelp"
                            class="form-text text-muted"
                            v-if="submitted && !$v.form.file_upload.required"
                          >
                            File is required
                          </small>
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
                <!-- <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <button
                        class="btn btn-primary"
                        type="submit"
                        v-on:click.prevent="handleSubmit()"
                      >
                        Submit
                      </button>
                    </div>
                  </div>
                </div> -->
              </div>
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
  props: ["id"],
  data() {
    return {
      form: {
        title: "",
        category: "",
        description: "",
        publisher: "",
        date: "",
        language: "",
        relation: "",
        user_id: localStorage.getItem("user_id"),
        right_management: "",
        creator: "",
        subject: "",
        type: "",
        format: "",
        contributor: "",
        identifier: "",
        source: "",
        coverage: "",
        status: "",
        division_information: "",
        file_upload: [],
        status: "",
      },
      submitted: false,
      loading: true,
    };
  },
  validations: {
    form: {
      title: { required },
      category: { required },
      description: { required },
      publisher: { required },
      date: { required },
      language: { required },
      relation: { required },
      user_id: localStorage.getItem("user_id"),
      right_management: { required },
      creator: { required },
      subject: { required },
      type: { required },
      format: { required },
      contributor: { required },
      identifier: { required },
      source: { required },
      coverage: { required },
      division_information: { required },
      file_upload: { required },
    },
  },
  computed: {
    categories() {
      return this.$store.getters.getAllCategories;
    },
    languages() {
      return this.$store.getters.getAllLanguages;
    },
  },
  watch: {
    $route(to, from) {
      this.getMyUpload();
    },
  },

  mounted() {
    this.getMyUpload();
    console.log(this.form.user_id);
    this.$store.dispatch("getCategory");
    this.$store.dispatch("getLanguage");
  },
  methods: {
    resetData() {
      this.form.title = "";
      this.form.category = "";
      this.form.description = "";
      this.form.publisher = "";
      this.form.date = "";
      this.form.language = "";
      this.form.relation = "";
      this.form.user_id = "";
      this.form.right_management = "";
      this.form.creator = "";
      this.form.subject = "";
      this.form.type = "";
      this.form.format = "";
      this.form.contributor = "";
      this.form.identifier = "";
      this.form.source = "";
      this.form.coverage = "";
      this.form.division_information = "";
      this.form.file_upload = "";
      this.$refs.file.value = null;
    },
    handleUploadPhoto() {
      console.log(this.$refs.file.files);
      this.form.file_upload = this.$refs.file.files;
    },

    handleSubmit() {
      console.log(this.form);
      this.submitted = false;
      //   this.$v.$touch();
      //   if (this.$v.$invalid) {
      //     return;
      //   }
      let formData = new FormData();
      formData.append("title", this.form.title);
      formData.append("category", this.form.category);
      formData.append("creator", this.form.creator);
      formData.append("subject", this.form.subject);
      formData.append("description", this.form.description);
      formData.append("publisher", this.form.publisher);
      formData.append("contributor", this.form.contributor);
      formData.append("date", this.form.date);
      formData.append("type", this.form.type);
      formData.append("format", this.form.format);
      formData.append("identifier", this.form.identifier);
      formData.append("source", this.form.source);
      formData.append("language", this.form.language);
      formData.append("relation", this.form.relation);
      formData.append("coverage", this.form.coverage);
      formData.append("division_information", this.form.division_information);
      for (const i of Object.keys(this.form.file_upload)) {
        formData.append(`file_upload[${i}]`, this.form.file_upload[i]);
      }
      formData.append("user_id", this.form.user_id);
      formData.append("right_management", this.form.right_management);

      axios
        .post("/api/upload-form", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          this.resetData();
          Vue.swal({
            icon: "success",
            title: "File successfully uploaded!",
          });
          console.log(res);
        });
    },

    getMyUpload() {
      this.loading = true;
      axios.get("/api/upload-form/" + this.id).then((res) => {
        this.loading = false;
        this.form.title = res.data.data.form.title;
        this.form.category = res.data.data.form.category;
        this.form.description = res.data.data.form.description;
        this.form.publisher = res.data.data.form.publisher;
        this.form.date = res.data.data.form.date;
        this.form.language = res.data.data.form.language;
        this.form.relation = res.data.data.form.relation;
        this.form.right_management = res.data.data.form.right_management;
        this.form.creator = res.data.data.form.upload_form_creator.map(
          ({ creator }) => creator
        );
        this.form.subject = res.data.data.form.upload_form_subject.map(
          ({ subject }) => subject
        );
        this.form.type = res.data.data.form.upload_form_type.map(
          ({ type }) => type
        );
        this.form.format = res.data.data.form.upload_form_format.map(
          ({ format }) => format
        );
        this.form.contributor = res.data.data.form.upload_form_contributor.map(
          ({ contributor }) => contributor
        );
        this.form.identifier = res.data.data.form.upload_form_identifier.map(
          ({ identifier }) => identifier
        );
        this.form.source = res.data.data.form.upload_form_source.map(
          ({ source }) => source
        );
        this.form.coverage = res.data.data.form.upload_form_coverage.map(
          ({ coverage }) => coverage
        );
        this.form.division_information = res.data.data.form.upload_form_division.map(
          ({ division }) => division
        );
        this.form.file_upload = res.data.data.form.upload_form_file;
        this.form.status = res.data.data.form.status;
        console.log(this.form.file_upload);
      });
    },
  },
};
</script>

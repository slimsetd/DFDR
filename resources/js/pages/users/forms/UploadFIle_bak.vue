<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Upload Files</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a
      > -->
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">title</label>
                    <input
                      type="text"
                      class="form-control"
                      id="title"
                      v-model="form.title"
                      aria-describedby="titleHelp"
                      placeholder="Enter Title"
                    />
                    <small id="titleHelp" class="form-text text-muted"
                      >We'll never share your email with anyone else.</small
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
                      aria-describedby="category"
                    >
                      <option
                        v-for="(cat, c) in categories"
                        :key="c"
                        :value="cat.id"
                        >{{ cat.category_name }}</option
                      >
                    </select>
                    <small id="category" class="form-text text-muted"
                      >Harap pilih salah satu tahun</small
                    >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                      class="form-control"
                      id="description"
                      v-model="form.description"
                      rows="3"
                      aria-describedby="descError"
                    ></textarea>
                    <small id="descError" class="form-text text-muted"
                      >Description tidak boleh kosong</small
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
                      v-model="form.publisher"
                      aria-describedby="publisherHelp"
                      placeholder="Enter publisher"
                    />
                    <small id="publisherHelp" class="form-text text-muted"
                      >We'll never share your email with anyone else.</small
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
                      v-model="form.date"
                      aria-describedby="dateError"
                      placeholder="Masukkan date"
                    />
                    <small id="dateError" class="form-text text-muted"
                      >date tidak boleh kosong</small
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
                      v-model="form.language"
                      aria-describedby="languageError"
                    >
                      <option
                        v-for="(lang, d) in languages"
                        :key="d"
                        :value="lang.id"
                        >{{ lang.language_name }}</option
                      >
                    </select>
                    <small id="languageError" class="form-text text-muted"
                      >Harap pilih salah satu departemen</small
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
                      v-model="form.relation"
                      aria-describedby="relationHelp"
                      placeholder="Enter relation"
                    />
                    <small id="relationHelp" class="form-text text-muted"
                      >We'll never share your email with anyone else.</small
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
                      v-model="form.right_management"
                      aria-describedby="right_managementHelp"
                      placeholder="Enter Right Management"
                    />
                    <small
                      id="right_managementHelp"
                      class="form-text text-muted"
                      >We'll never share your email with anyone else.</small
                    >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div
                        class="col-md-10"
                        v-for="(creat, index) in form.creator"
                        :key="index"
                      >
                        <label>Creator</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="creat.creator_name"
                          aria-describedby="creatorHelp"
                          placeholder="Enter creator"
                          :name="`form.creator[${index}][creator_name]`"
                        />
                        <small id="creatorHelp" class="form-text text-muted"
                          >We'll never share your email with anyone else.</small
                        >
                      </div>
                      <div class="col-md-2">
                        <div class="form-group mt-4">
                          <b-button
                            v-b-modal.modal-1
                            variant="success"
                            v-b-tooltip.hover
                            title="Add Creator"
                            v-on:click="addCreator()"
                            ><i class="fas fa-fw fa-plus"></i
                          ></b-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div
                        class="col-md-10"
                        v-for="(sub, index) in form.subject"
                        :key="index"
                      >
                        <label for="subject">Subject</label>
                        <input
                          type="text"
                          class="form-control"
                          id="subject"
                          v-model="sub.subject_name"
                          aria-describedby="subjectHelp"
                          placeholder="Enter subject"
                          :name="`form.subject[${index}][subject_name]`"
                        />
                        <small id="subjectHelp" class="form-text text-muted"
                          >We'll never share your email with anyone else.</small
                        >
                      </div>
                      <div class="col-md-2">
                        <div class="form-group mt-4">
                          <b-button
                            v-b-modal.modal-1
                            variant="success"
                            v-b-tooltip.hover
                            title="Add Subject"
                            v-on:click="addSubject()"
                            ><i class="fas fa-fw fa-plus"></i
                          ></b-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div
                        class="col-md-10"
                        v-for="(typ, index) in form.type"
                        :key="index"
                      >
                        <label for="type">Type</label>
                        <input
                          type="text"
                          class="form-control"
                          id="type"
                          v-model="typ.type_name"
                          aria-describedby="typeHelp"
                          placeholder="Enter type"
                          :name="`form.type[${index}][type_name]`"
                        />
                        <small id="typeHelp" class="form-text text-muted"
                          >We'll never share your email with anyone else.</small
                        >
                      </div>
                      <div class="col-md-2">
                        <div class="form-group mt-4">
                          <b-button
                            v-b-modal.modal-1
                            variant="success"
                            v-b-tooltip.hover
                            title="Add type"
                            v-on:click="addType()"
                            ><i class="fas fa-fw fa-plus"></i
                          ></b-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div
                        class="col-md-10"
                        v-for="(frmt, index) in form.format"
                        :key="index"
                      >
                        <label for="format">Format</label>
                        <input
                          type="text"
                          class="form-control"
                          id="format"
                          v-model="frmt.format_name"
                          aria-describedby="formatHelp"
                          placeholder="Enter format"
                          :name="`form.format[${index}][format_name]`"
                        />
                        <small id="formatHelp" class="form-text text-muted"
                          >We'll never share your email with anyone else.</small
                        >
                      </div>
                      <div class="col-md-2">
                        <div class="form-group mt-4">
                          <b-button
                            v-b-modal.modal-1
                            variant="success"
                            v-b-tooltip.hover
                            title="Add format"
                            v-on:click="addFormat()"
                            ><i class="fas fa-fw fa-plus"></i
                          ></b-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div
                        class="col-md-10"
                        v-for="(cont, index) in form.contributor"
                        :key="index"
                      >
                        <label for="contributor">Contributor</label>
                        <input
                          type="text"
                          class="form-control"
                          id="contributor"
                          v-model="cont.contributor_name"
                          aria-describedby="contributorHelp"
                          placeholder="Enter contributor"
                          :name="`form.contributor[${index}][contributor_name]`"
                        />
                        <small id="contributorHelp" class="form-text text-muted"
                          >We'll never share your email with anyone else.</small
                        >
                      </div>
                      <div class="col-md-2">
                        <div class="form-group mt-4">
                          <b-button
                            v-b-modal.modal-1
                            variant="success"
                            v-b-tooltip.hover
                            title="Add contributor"
                            v-on:click="addContributor()"
                            ><i class="fas fa-fw fa-plus"></i
                          ></b-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div
                        class="col-md-10"
                        v-for="(iden, index) in form.identifier"
                        :key="index"
                      >
                        <label for="identifier">Identifier</label>
                        <input
                          type="text"
                          class="form-control"
                          id="identifier"
                          v-model="iden.identifier_name"
                          aria-describedby="identifierHelp"
                          placeholder="Enter identifier"
                          :name="`form.identifier[${index}][identifier_name]`"
                        />
                        <small id="identifierHelp" class="form-text text-muted"
                          >We'll never share your email with anyone else.</small
                        >
                      </div>
                      <div class="col-md-2">
                        <div class="form-group mt-4">
                          <b-button
                            v-b-modal.modal-1
                            variant="success"
                            v-b-tooltip.hover
                            title="Add identifier"
                            v-on:click="addIdentifier()"
                            ><i class="fas fa-fw fa-plus"></i
                          ></b-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div
                        class="col-md-10"
                        v-for="(sour, index) in form.source"
                        :key="index"
                      >
                        <label for="source">Source</label>
                        <input
                          type="text"
                          class="form-control"
                          id="source"
                          v-model="sour.source_name"
                          aria-describedby="sourceHelp"
                          placeholder="Enter source"
                          :name="`form.source[${index}][source_name]`"
                        />
                        <small id="sourceHelp" class="form-text text-muted"
                          >We'll never share your email with anyone else.</small
                        >
                      </div>
                      <div class="col-md-2">
                        <div class="form-group mt-4">
                          <b-button
                            v-b-modal.modal-1
                            variant="success"
                            v-b-tooltip.hover
                            title="Add source"
                            v-on:click="addSource()"
                            ><i class="fas fa-fw fa-plus"></i
                          ></b-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div
                        class="col-md-10"
                        v-for="(cov, index) in form.coverage"
                        :key="index"
                      >
                        <label for="coverage">Coverage</label>
                        <input
                          type="text"
                          class="form-control"
                          id="coverage"
                          v-model="cov.coverage_name"
                          aria-describedby="coverageHelp"
                          placeholder="Enter coverage"
                          :name="`form.coverage[${index}][coverage_name]`"
                        />
                        <small id="coverageHelp" class="form-text text-muted"
                          >We'll never share your email with anyone else.</small
                        >
                      </div>
                      <div class="col-md-2">
                        <div class="form-group mt-4">
                          <b-button
                            v-b-modal.modal-1
                            variant="success"
                            v-b-tooltip.hover
                            title="Add coverage"
                            v-on:click="addCoverage()"
                            ><i class="fas fa-fw fa-plus"></i
                          ></b-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div
                        class="col-md-10"
                        v-for="(div, index) in form.division_information"
                        :key="index"
                      >
                        <label for="division_information"
                          >Division Information</label
                        >
                        <input
                          type="text"
                          class="form-control"
                          id="division_information"
                          v-model="div.division_information_name"
                          aria-describedby="division_informationHelp"
                          placeholder="Enter division information"
                          :name="
                            `form.division_information[${index}][division_information_name]`
                          "
                        />
                        <small
                          id="division_informationHelp"
                          class="form-text text-muted"
                          >We'll never share your email with anyone else.</small
                        >
                      </div>
                      <div class="col-md-2">
                        <div class="form-group mt-4">
                          <b-button
                            v-b-modal.modal-1
                            variant="success"
                            v-b-tooltip.hover
                            title="Add division information"
                            v-on:click="addDivision()"
                            ><i class="fas fa-fw fa-plus"></i
                          ></b-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="row">
                      <div>
                        {{ form.file_upload }}
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

                        <small id="upload_fileHelp" class="form-text text-muted">
                          We'll never share your email with anyone else.
                        </small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <b-button
                      v-b-modal.modal-1
                      variant="success"
                      v-on:click="handleSubmit()"
                      >Submit</b-button
                    >
                  </div>
                </div>
              </div>
            </form>
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
        creator: [
          {
            creator_name: "",
          },
        ],
        subject: [
          {
            subject_name: "",
          },
        ],
        type: [
          {
            type_name: "",
          },
        ],
        format: [{ format_name: "" }],
        contributor: [{ contributor_name: "" }],
        identifier: [{ identifier_name: "" }],
        source: [{ source_name: "" }],
        coverage: [{ coverage_name: "" }],
        division_information: [{ division_information_name: "" }],
        file_upload: [],
      },
    };
  },
  computed: {
    categories() {
      return this.$store.getters.getAllCategories;
    },
    languages() {
      return this.$store.getters.getAllLanguages;
    },
  },
  mounted() {
    console.log(this.form.user_id);
    this.$store.dispatch("getCategory");
    this.$store.dispatch("getLanguage");
  },
  methods: {
    addCreator() {
      this.form.creator.push({
        creator_name: "",
      });
      console.log(this.form.creator[0].creator_name);
    },

    addSubject() {
      this.form.subject.push({
        subject_name: "",
      });
      console.log(this.form.subject);
    },

    addType() {
      this.form.type.push({
        type_name: "",
      });
      console.log(this.form.type);
    },

    addFormat() {
      this.form.format.push({
        format_name: "",
      });
      console.log(this.form.format);
    },

    addContributor() {
      this.form.contributor.push({
        contributor_name: "",
      });
      console.log(this.form.contributor);
    },

    addIdentifier() {
      this.form.identifier.push({
        identifier_name: "",
      });
      console.log(this.form.identifier);
    },

    addSource() {
      this.form.source.push({
        source_name: "",
      });
      console.log(this.form.source);
    },

    addCoverage() {
      this.form.coverage.push({
        coverage_name: "",
      });
      console.log(this.form.coverage);
    },

    addDivision() {
      this.form.division_information.push({
        division_information_name: "",
      });
      console.log(this.form.division_information);
    },

    addFile() {
      this.form.file_upload.push("");
      console.log(this.form.file_upload);
    },

    handleUploadPhoto() {
      console.log(this.$refs.file.files);
      this.form.file_upload = this.$refs.file.files
      // console.log()
      // console.log('test');
      // console.log("bisa nih geslksu");
      // this.form.file_upload.push({
      //   file_upload_name: this.$refs.file[0].files[0],
      // });
      // console.log(this.$refs.file[0].files[0]);
      // console.log(this.form.file_upload);
    },

    handleSubmit() {
      console.log(this.form);
      let formData = new FormData();
      formData.append("title", this.form.title);
      formData.append("category", this.form.category);
      formData.append("creator", JSON.stringify(this.form.creator));
      formData.append("subject", JSON.stringify(this.form.subject));
      formData.append("description", this.form.description);
      formData.append("publisher", this.form.publisher);
      formData.append("contributor", JSON.stringify(this.form.contributor));
      formData.append("date", this.form.date);
      formData.append("type", JSON.stringify(this.form.type));
      formData.append("format", JSON.stringify(this.form.format));
      formData.append("identifier", JSON.stringify(this.form.identifier));
      formData.append("source", JSON.stringify(this.form.source));
      formData.append("language", this.form.language);
      formData.append("relation", this.form.relation);
      formData.append("coverage", JSON.stringify(this.form.coverage));
      formData.append(
        "division_information",
        JSON.stringify(this.form.division_information)
      );
      // formData.append("file_upload", this.form.file_upload);
      for(const i of Object.keys(this.form.file_upload)) {
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
          console.log(res);
        });
    },
  },
};
</script>

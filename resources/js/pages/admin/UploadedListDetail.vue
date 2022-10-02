<template>
  <div class="container-fluid mt-4 mb-4">
    <div class="row justify-content-center">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="text-center" v-if="loading">
          <loading-component></loading-component>
        </div>
        <div v-if="!loading">
          <div v-if="showDetail">
            <div class="card p-4 mt-3">
              <div class="card-body">
                <a
                  v-on:click="onDetail()"
                  style="cursor: pointer; color: blue;"
                >
                  Show simple item record</a
                >
                <div class="row">
                  <div class="col-md-12">
                    <h3 class="text-center">{{ this.submissions.title }}</h3>
                  </div>
                </div>
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th scope="row">Date</th>
                      <td>{{ this.submissions.date }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Description</th>
                      <td><div v-html="submissions.description"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">Language</th>
                      <td>{{ this.language }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Publisher</th>
                      <td>{{ this.submissions.publisher }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Relation</th>
                      <td>{{ this.submissions.relation }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Contributor</th>
                      <td>
                        <ul>
                          <li
                            v-for="(cont,
                            cnt) in submissions.upload_form_contributor"
                            :key="cnt"
                          >
                            {{ cont.contributor }}
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Coverage</th>
                      <td>
                        <ul>
                          <li
                            v-for="(cov,
                            cv) in submissions.upload_form_coverage"
                            :key="cv"
                          >
                            {{ cov.coverage }}
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Creator</th>
                      <td>
                        <ul>
                          <li
                            v-for="(cre, cr) in submissions.upload_form_creator"
                            :key="cr"
                          >
                            {{ cre.creator }}
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Division</th>
                      <td>
                        <ul>
                          <li
                            v-for="(div,
                            dv) in submissions.upload_form_division"
                            :key="dv"
                          >
                            {{ div.division }}
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Format</th>
                      <td>
                        <ul>
                          <li
                            v-for="(form, fr) in submissions.upload_form_format"
                            :key="fr"
                          >
                            {{ form.format }}
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Identifier</th>
                      <td>
                        <ul>
                          <li
                            v-for="(iden,
                            id) in submissions.upload_form_identifier"
                            :key="id"
                          >
                            {{ iden.identifier }}
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Source</th>
                      <td>
                        <ul>
                          <li
                            v-for="(src, sr) in submissions.upload_form_source"
                            :key="sr"
                          >
                            {{ src.source }}
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Subject</th>
                      <td>
                        <ul>
                          <li
                            v-for="(sub, sb) in submissions.upload_form_subject"
                            :key="sb"
                          >
                            {{ sub.subject }}
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Type</th>
                      <td>
                        <ul>
                          <li
                            v-for="(typ, ty) in submissions.upload_form_type"
                            :key="ty"
                          >
                            {{ typ.type }}
                          </li>
                        </ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-md-12">
                    <h3>File in this Submission</h3>
                    <ul class="list-group">
                      <li
                        class="list-group-item"
                        v-for="(file, f) in submissions.upload_form_file"
                        :key="f"
                      >
                        <p v-show="submissions.right_management == 'Close'">
                          {{ file.file_name }} ( {{ file.file_size }} )
                        </p>
                        <a
                          :href="
                            '/storage/uploads/file_upload/' + file.file_name
                          "
                          target="_blank"
                          v-show="submissions.right_management == 'Open'"
                        >
                          {{ file.file_name }} ( {{ file.file_size }} )
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mt-4">
                    <h3>This item appears in the following category</h3>
                    <h5 class="cat">{{ this.category_name }}</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mt-4">
                    <a
                      v-on:click="onDetail()"
                      style="cursor: pointer; color: blue;"
                    >
                      Show simple item record</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-if="!showDetail">
            <div class="row">
              <div class="col-md-9">
                <div class="card p-4 mb-4">
                  <div class="card-body">
                    <h3 class="text-center">{{ this.submissions.title }}</h3>
                    <div v-html="submissions.description"></div>
                    <hr />
                    <h6>
                      This submission appears in the following category:
                    </h6>
                    <p class="sub-text cat">{{ this.category_name }}</p>

                    <!-- <template>
                      <pdf src="/storage/uploads/file_upload/file.pdf"></pdf>
                    </template> -->

                    <div id="pdf-view"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card p-2">
                  <div class="card-body">
                    <h6>File</h6>
                    <ul class="list-group">
                      <li
                        class="list-group-item text-center"
                        v-for="(file, f) in submissions.upload_form_file"
                        :key="f"
                      >
                        <p style="font-size: 13px;">
                          {{ file.file_name }}
                        </p>
                        <!-- <p
                          v-on:click.prevent="
                            downloadedFile(submissions.id, file.file_name)
                          "
                        ></p> -->
                        <!-- <a
                          :href="
                            '/storage/uploads/file_upload/' + file.file_name
                          "
                          target="_blank"
                          v-show="submissions.right_management == 'Open'"
                        >
                          {{ file.file_name }}
                        </a> -->
                        <hr>
                        <!-- <p v-show="submissions.right_management == 'Close'" style="font-size: 9px;">
                          <router-link
                            style="color: blue;"
                            :to="{
                              name: 'Login',
                            }"
                            >Login </router-link
                          >
                          to Download / View file
                        </p>   -->

                        <button
                          type="button"
                          class="btn btn-primary btn-sm"
                          style="margin-right:2px;"
                          v-on:click.prevent="downloadedFile(file)"
                        >
                          <i class="fa fa-download"></i>
                        </button>
                        <button
                          type="button"
                          class="btn btn-success btn-sm"
                          v-on:click.prevent="readFile(file)"
                        >
                          <i class="fa fa-eye"></i>
                        </button>
                      </li>
                    </ul>
                    <hr />
                    <div>
                      <h6>Total Download : </h6>
                      <span style="font-weight: bold; margin-left: 12px;"
                        >{{ tDownload }}</span
                      >
                    </div>
                    <hr />
                    <div>
                      <h6>Total View : </h6>
                      <span style="font-weight: bold; margin-left: 12px;"
                        >{{ tView }}</span
                      >
                    </div>
                    <hr />
                    <div>
                      <h6>Creator : </h6>
                      <ul style="margin:0px; padding-left:15px;">
                        <li
                          style="margin-left:15px; padding:0px;"
                          v-for="(creator,
                          f) in submissions.upload_form_creator"
                          :key="f"
                        >
                          {{ creator.creator }}
                        </li>
                      </ul>
                    </div>
                    <hr />
                    <div>
                      <h6>Metadata : </h6>
                      <a
                        v-on:click="onDetail()"
                        style="cursor: pointer; color: blue; font-size: 13px; padding-left:15px;"
                      >
                        Show Full Records</a
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
</template>

<style scoped>
.card {
  box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
  border-radius: 1rem !important;
}
</style>

<script>
import pdf from 'vue-pdf'

export default {
  components: {
    pdf
  },
  props: ["id"],
  data() {
    return {
      showDetail: false,
      submissions: {},
      tDownload: "",
      tView: "",
      loading: true,
      category_name: "",
      language: "",
    };
  },
  mounted() {
    this.getDetailSubmission();
    // console.log(this.id);
  },

  methods: {
    downloadedFile(filename) {
      let formData = {
        click: "Download",
      };

      axios
      .post("/api/upload-form/increments/" + this.id, formData)
      .then((res) => 
      {
        // console.log(res.data.data);
        if (res) {
          var file_path = "/storage/uploads/file_upload/" + filename.file_name;
          var a = document.createElement("A");
          a.href = file_path;
          a.download = file_path.substr(file_path.lastIndexOf("/") + 1);
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a);

          // this.reGetSubmission();
        }
      });
    },
    readFile(filename) {
      // --- view PDF with browser default setting & without IDM force download (On Page) ---
      // var file_path = "/storage/uploads/file_upload/" + filename.file_name;
      // var obj = document.createElement('object');
      // obj.style.width = '100%';
      // obj.style.height = '530pt';
      // obj.type = 'application/pdf';
      // obj.data = file_path;
      // window.open(obj);
      // document.getElementById("pdf-view").appendChild(obj);

      let formData = {
        click: "View",
      };

      axios
      .post("/api/upload-form/increments/" + this.id, formData)
      .then((res) => 
      {
        // console.log(res.data.data);
        if (res) 
        {
          // --- view PDF with browser default setting & without IDM force download (Off Page) ---
          var file_path = "/storage/uploads/file_upload/" + filename.file_name;
          window.open(file_path, 'fullscreen=yes');
          
          // this.reGetSubmission();
        }
      });
    },

    toDetailCategory(id) {
      this.updated = true;
      axios.get("/api/category/" + id).then((res) => {
        this.category_name = res.data.data.category.category_name;
      });
    },
    toDetailLanguage(id) {
      this.updated = true;
      axios.get("/api/language/" + id).then((res) => {
        this.language = res.data.data.language.language_name;
      });
    },
    getDetailSubmission() {
      this.loading = true;
      axios.get("/api/upload-form/" + this.id).then((res) => {
        this.submissions = res.data.data.form;

        var datArr = this.submissions.total_download.split("-");
        this.tDownload = datArr[0];
        this.tView = datArr[1];

        this.loading = false;
        this.toDetailCategory(res.data.data.form.category);
        this.toDetailLanguage(res.data.data.form.language);
        // console.log(this.submissions);
      });
    },
    reGetSubmission() {
      axios
      .get("/api/upload-form/" + this.id)
      .then((res) => {
        var datArr = this.submissions.total_download.split("-");
        this.tDownload = datArr[0];
        this.tView = datArr[1];
      });
    },

    onDetail() {
      this.showDetail = !this.showDetail;
      // console.log(this.showDetail);
    },
  },
};
</script>

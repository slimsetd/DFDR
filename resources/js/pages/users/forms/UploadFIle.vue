<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Upload Deposit</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"
        ><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a
      > -->
      <a
        @click="$router.go(-1)"
        class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
        ><i class="fas fa-arrow-left fa-sm text-white-50"></i>&nbsp; Return</a
      >
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form enctype="multipart/form-data">
              <div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input
                        type="text"
                        class="form-control"
                        id="title"
                        v-model="form.title"
                        aria-describedby="titleHelp"
                        placeholder="Enter Title.."
                        v-on:change="checkTitle()"
                      />
                      <small
                        id="titleHelp"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.title.required"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp; Title
                        is required</small
                      >
                      <small
                        id="titleHelp"
                        class="form-text text-muted"
                        v-if="sameTitle && $v.form.title.required"
                        ><i class="fa fa-times"></i>&nbsp; Same Title already
                        exist</small
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
                        aria-describedby="categoryHelp"
                      >
                        <option value="" selected disabled>- - -</option>
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
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp; Please
                        choose one</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description">Description</label>
                      <vue-editor v-model="form.description" />
                      <small
                        id="descError"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.description.required"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                        Description is required</small
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
                        placeholder="Enter publisher.."
                      />
                      <small
                        id="publisherHelp"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.publisher.required"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                        Publisher is required</small
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
                      />
                      <small
                        id="dateError"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.date.required"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp; Date is
                        required</small
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
                        <option value="" selected disabled>- - -</option>
                        <option
                          v-for="(lg, d) in languages"
                          :key="d"
                          :value="lg.id"
                          >{{ lg.language_name }}</option
                        >
                      </select>
                      <small
                        id="languageError"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.language.required"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                        Language is required</small
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
                        placeholder="Enter relation.."
                      />
                      <small
                        id="relationHelp"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.relation.required"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                        Relation is required</small
                      >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="right_management">Right Management</label>
                      <select
                        class="form-control"
                        id="right_management"
                        v-model="form.right_management"
                        aria-describedby="right_managementHelp"
                      >
                        <option value="" selected disabled>- - -</option>
                        <option value="Open"> Open</option>
                        <option value="Close"> Close</option>
                      </select>
                      <small
                        id="right_managementHelp"
                        class="form-text text-muted"
                        v-if="submitted && !$v.form.right_management.required"
                        ><i class="fa fa-info-circle text-xs"></i>&nbsp; Please
                        choose one</small
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div
                        class="row"
                        v-for="(creat, index) in form.creator"
                        :key="index"
                      >
                        <div class="col-md-8">
                          <label>Creator</label>
                          <input
                            type="text"
                            class="form-control"
                            v-model="creat.creator_name"
                            aria-describedby="creatorHelp"
                            placeholder="Enter creator.."
                            :name="`form.creator[${index}][creator_name]`"
                          />
                          <small
                            id="creatorHelp"
                            class="form-text text-muted"
                            v-if="submitted && $v.form.creator.$error"
                            ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                            Creator is required</small
                          >
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mt-4">
                            <b-button
                              v-show="form.creator.length > 1"
                              v-b-modal.modal-1
                              variant="danger"
                              v-b-tooltip.hover
                              title="Delete"
                              v-on:click="
                                deleteCreator(index, creat.creator_name)
                              "
                              ><i class="fas fa-fw fa-trash"></i
                            ></b-button>
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
                      <div
                        class="row"
                        v-for="(creat, index) in form.subject"
                        :key="index"
                      >
                        <div class="col-md-8">
                          <label>Subject</label>
                          <select
                            class="form-control"
                            id="subject"
                            v-model="creat.subject_name"
                            aria-describedby="subjectHelp"
                            placeholder="Enter subject"
                            :name="`form.subject[${index}][subject_name]`"
                          >
                            <option value="" selected disabled>- - -</option>
                            <option
                              v-for="(sub, d) in subjects"
                              :key="d"
                              :value="sub.subject_name"
                              >{{ sub.subject_name }}</option
                            >
                          </select>

                          <small
                            id="subjectHelp"
                            class="form-text text-muted"
                            v-if="submitted && $v.form.subject.$error"
                            ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                            Please choose one</small
                          >
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mt-4">
                            <b-button
                              v-show="form.subject.length > 1"
                              v-b-modal.modal-1
                              variant="danger"
                              v-b-tooltip.hover
                              title="Delete"
                              v-on:click="
                                deleteSubject(index, creat.subject_name)
                              "
                              ><i class="fas fa-fw fa-trash"></i
                            ></b-button>
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
                      <div
                        class="row"
                        v-for="(creat, index) in form.type"
                        :key="index"
                      >
                        <div class="col-md-8">
                          <label>Type</label>
                          <input
                            type="text"
                            class="form-control"
                            v-model="creat.type_name"
                            aria-describedby="typeHelp"
                            placeholder="Enter type.."
                            :name="`form.type[${index}][type_name]`"
                          />
                          <small
                            id="typeHelp"
                            class="form-text text-muted"
                            v-if="submitted && $v.form.type.$error"
                            ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                            Type is required</small
                          >
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mt-4">
                            <b-button
                              v-show="form.type.length > 1"
                              v-b-modal.modal-1
                              variant="danger"
                              v-b-tooltip.hover
                              title="Delete"
                              v-on:click="deleteType(index, creat.type_name)"
                              ><i class="fas fa-fw fa-trash"></i
                            ></b-button>
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
                      <div
                        class="row"
                        v-for="(creat, index) in form.format"
                        :key="index"
                      >
                        <div class="col-md-8">
                          <label>Format</label>
                          <input
                            format="text"
                            class="form-control"
                            v-model="creat.format_name"
                            aria-describedby="formatHelp"
                            placeholder="Enter format.."
                            :name="`form.format[${index}][format_name]`"
                          />
                          <small
                            id="formatHelp"
                            class="form-text text-muted"
                            v-if="submitted && $v.form.format.$error"
                            ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                            Format is required</small
                          >
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mt-4">
                            <b-button
                              v-show="form.format.length > 1"
                              v-b-modal.modal-1
                              variant="danger"
                              v-b-tooltip.hover
                              title="Delete"
                              v-on:click="
                                deleteFormat(index, creat.format_name)
                              "
                              ><i class="fas fa-fw fa-trash"></i
                            ></b-button>
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
                      <div
                        class="row"
                        v-for="(creat, index) in form.contributor"
                        :key="index"
                      >
                        <div class="col-md-8">
                          <label>Contributor</label>
                          <input
                            format="text"
                            class="form-control"
                            v-model="creat.contributor_name"
                            aria-describedby="contributorHelp"
                            placeholder="Enter contributor.."
                            :name="
                              `form.contributor[${index}][contributor_name]`
                            "
                          />
                          <small
                            id="contributorHelp"
                            class="form-text text-muted"
                            v-if="submitted && $v.form.contributor.$error"
                            ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                            Contributor is required</small
                          >
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mt-4">
                            <b-button
                              v-show="form.contributor.length > 1"
                              v-b-modal.modal-1
                              variant="danger"
                              v-b-tooltip.hover
                              title="Delete"
                              v-on:click="
                                deleteContributor(index, creat.contributor_name)
                              "
                              ><i class="fas fa-fw fa-trash"></i
                            ></b-button>
                            <b-button
                              v-b-modal.modal-1
                              variant="success"
                              v-b-tooltip.hover
                              title="Add Contributor"
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
                      <div
                        class="row"
                        v-for="(creat, index) in form.identifier"
                        :key="index"
                      >
                        <div class="col-md-8">
                          <label>Identifier</label>
                          <input
                            format="text"
                            class="form-control"
                            v-model="creat.identifier_name"
                            aria-describedby="identifierHelp"
                            placeholder="Enter identifier.."
                            :name="`form.identifier[${index}][identifier_name]`"
                          />
                          <small
                            id="identifierHelp"
                            class="form-text text-muted"
                            v-if="submitted && $v.form.identifier.$error"
                            ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                            Identifier is required</small
                          >
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mt-4">
                            <b-button
                              v-show="form.identifier.length > 1"
                              v-b-modal.modal-1
                              variant="danger"
                              v-b-tooltip.hover
                              title="Delete"
                              v-on:click="
                                deleteIdentifier(index, creat.identifier_name)
                              "
                              ><i class="fas fa-fw fa-trash"></i
                            ></b-button>
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
                      <div
                        class="row"
                        v-for="(creat, index) in form.source"
                        :key="index"
                      >
                        <div class="col-md-8">
                          <label>Source</label>
                          <input
                            format="text"
                            class="form-control"
                            v-model="creat.source_name"
                            aria-describedby="sourceHelp"
                            placeholder="Enter source.."
                            :name="`form.source[${index}][source_name]`"
                          />
                          <small
                            id="sourceHelp"
                            class="form-text text-muted"
                            v-if="submitted && $v.form.source.$error"
                            ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                            Source is required</small
                          >
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mt-4">
                            <b-button
                              v-show="form.source.length > 1"
                              v-b-modal.modal-1
                              variant="danger"
                              v-b-tooltip.hover
                              title="Delete"
                              v-on:click="
                                deleteSource(index, creat.source_name)
                              "
                              ><i class="fas fa-fw fa-trash"></i
                            ></b-button>
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
                      <div
                        class="row"
                        v-for="(creat, index) in form.coverage"
                        :key="index"
                      >
                        <div class="col-md-8">
                          <label>Coverage</label>
                          <input
                            format="text"
                            class="form-control"
                            v-model="creat.coverage_name"
                            aria-describedby="coverageHelp"
                            placeholder="Enter coverage.."
                            :name="`form.coverage[${index}][coverage_name]`"
                          />
                          <small
                            id="coverageHelp"
                            class="form-text text-muted"
                            v-if="submitted && $v.form.coverage.$error"
                            ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                            Coverage is required</small
                          >
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mt-4">
                            <b-button
                              v-show="form.coverage.length > 1"
                              v-b-modal.modal-1
                              variant="danger"
                              v-b-tooltip.hover
                              title="Delete"
                              v-on:click="
                                deleteCoverage(index, creat.coverage_name)
                              "
                              ><i class="fas fa-fw fa-trash"></i
                            ></b-button>
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
                  <!-- <div class="col-md-6">
                    <div class="form-group">
                      <div
                        class="row"
                        v-for="(creat, index) in form.division_information"
                        :key="index"
                      >
                        <div class="col-md-8">
                          <label>Division Information</label>
                          <select
                            class="form-control"
                            id="division_information"
                            v-model="creat.division_information_name"
                            aria-describedby="division_informationHelp"
                            placeholder="Enter division information"
                            :name="
                              `form.division_information[${index}][division_information_name]`
                            "
                          >
                            <option value="" selected disabled>- - -</option>
                            <option
                              v-for="(dv, d) in divisions"
                              :key="d"
                              :value="dv.division_name"
                              >{{ dv.division_name }}</option
                            >
                          </select>

                          <small
                            id="subjectHelp"
                            class="form-text text-muted"
                            v-if="
                              submitted && $v.form.division_information.$error
                            "
                            ><i class="fa fa-info-circle text-xs"></i>&nbsp;
                            Division is required</small
                          >
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mt-4">
                            <b-button
                              v-show="form.division_information.length > 1"
                              v-b-modal.modal-1
                              variant="danger"
                              v-b-tooltip.hover
                              title="Delete"
                              v-on:click="
                                deleteDivision(
                                  index,
                                  creat.division_information_name
                                )
                              "
                              ><i class="fas fa-fw fa-trash"></i
                            ></b-button>
                            <b-button
                              v-b-modal.modal-1
                              variant="success"
                              v-b-tooltip.hover
                              title="Add division_information"
                              v-on:click="addDivision()"
                              ><i class="fas fa-fw fa-plus"></i
                            ></b-button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>

                <!-- File upload -->
                <b-row>
                  <div
                    v-for="(file, i) in form.file_upload"
                    :key="i"
                    class="ml-3"
                  >
                    <!-- Form File upload  -->
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-8">
                              <label for="upload_file">File{{ i + 1 }}</label>
                              <input
                                type="file"
                                ref="documentFile"
                                @change="handleUploadCard(i)"
                                class="form-control-file"
                                id="photo"
                              />

                              <small
                                id="upload_fileHelp"
                                class="form-text text-muted"
                                v-if="
                                  submitted && !$v.form.file_upload.required
                                "
                              >
                                <i class="fa fa-info-circle text-xs"></i>&nbsp;
                                File is required
                              </small>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group mt-4">
                                 <b-form-checkbox v-model="form.is_private[i]" name="check-button" switch>
    </b-form-checkbox>
                                <b-button
                                  v-if="form.file_upload.length > 1"
                                  v-b-modal.modal-1
                                  variant="danger"
                                  v-b-tooltip.hover
                                  title="Delete"
                                  v-on:click="removeForm(i)"
                                  ><i class="fas fa-fw fa-trash"></i
                                ></b-button>
                                <b-button
                                  v-b-modal.modal-1
                                  variant="success"
                                  v-b-tooltip.hover
                                  title="Add"
                                  v-on:click="addForm(i)"
                                  ><i class="fas fa-fw fa-plus"></i
                                ></b-button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Form file upload -->
                  </div>
                </b-row>

                <!-- End File upload  -->

                <div class="row">
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
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.text-muted {
  color: red !important;
}
</style>

<script>
import { required, minLength } from "vuelidate/lib/validators";
import { VueEditor } from "vue2-editor";

export default {
  data() {
    return {
      loading: false,
      submitted: false,
      wrongFile: false,
      sameTitle: false,
      content: "",
      // files: [],
      form: {
        is_private: [],
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
        // division_information: [{ division_information_name: "" }],
        file_upload: [{}],
      },
      userdata: JSON.parse(localStorage.getItem("user")),
    };
  },
  validations: {
    form: {
      title: { required },
      category: { required },
      description: { required, minLength: minLength(9) },
      publisher: { required },
      date: { required },
      language: { required },
      relation: { required },
      right_management: { required },
      file_upload: { required },
      creator: {
        $each: {
          creator_name: { required },
        },
      },
      subject: {
        $each: {
          subject_name: { required },
        },
      },
      type: {
        $each: {
          type_name: { required },
        },
      },
      format: {
        $each: {
          format_name: { required },
        },
      },
      contributor: {
        $each: {
          contributor_name: { required },
        },
      },
      identifier: {
        $each: {
          identifier_name: { required },
        },
      },
      source: {
        $each: {
          source_name: { required },
        },
      },
      coverage: {
        $each: {
          coverage_name: { required },
        },
      },
      // division_information: {
      //   $each: {
      //     division_information_name: { required },
      //   },
      // },
    },
  },
  computed: {
    categories() {
      return this.$store.getters.getAllCategories;
    },
    languages() {
      return this.$store.getters.getAllLanguages;
    },
    subjects() {
      return this.$store.getters.getAllSubject;
    },
    divisions() {
      return this.$store.getters.getAllDivisions;
    },
  },
  mounted() {
    // console.log(this.form.user_id);
    this.$store.dispatch("getCategory");
    this.$store.dispatch("getLanguage");
    this.$store.dispatch("getSubject");
    this.$store.dispatch("getDivision");
  },
  methods: {
    removeForm(i) {
      this.form.file_upload.splice(i, 1);
    },
    addForm(i) {
      this.form.file_upload.push({ name: "", file: null });
    },
    capFLetter(string) {
      return string.replace(/(^\w{1})|(\s+\w{1})/g, (letter) =>
        letter.toUpperCase()
      );
    },

    handleUploadCard(i) {
      console.log(this.$refs.documentFile[i].files[0]);
      // console.log(this.$refs.documentFile);
      this.form.file_upload[i] = this.$refs.documentFile[i].files[0];
      // if (this.$refs.file.files.length != 0) {
      //   console.log(this.$refs.file.files[0].type);

      //   this.form.file_upload[i] = this.$refs.file.files[0];
      //   // this.form.upload_card = this.$refs.file.files[0];
      //   // var type = this.$refs.file.files[0].type;

      //   // if (type === 'application/pdf')
      //   //   this.wrongFile = false;
      //   // else
      //   //   this.wrongFile = true;
      // } else {
      //   this.wrongFile = false;
      // }
      // console.log(this.wrongFile);
    },

    checkTitle() {
      if (this.form.title != "") {
        let formData = new FormData();
        formData.append("title", this.form.title);
        // console.log(formData);
        axios
          .post("/api/upload-form/checkTitle", formData)
          .then((res) => {
            if (res.data.status == "Success") this.sameTitle = false;
            else this.sameTitle = true;
            // console.log(res.data);
          })
          .catch((err) => {
            console.log(err);
          });
      } else this.sameTitle = false;
    },

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
      // this.form.division_information = "";
      this.form.file_upload = [];
      this.$refs.file.value = null;
    },

    addCreator() {
      this.form.creator.push({
        creator_name: "",
      });
      // console.log(this.form.creator);
    },

    addSubject() {
      this.form.subject.push({
        subject_name: "",
      });
      // console.log(this.form.subject);
    },

    addType() {
      this.form.type.push({
        type_name: "",
      });
      // console.log(this.form.type);
    },

    addFormat() {
      this.form.format.push({
        format_name: "",
      });
      // console.log(this.form.format);
    },

    addContributor() {
      this.form.contributor.push({
        contributor_name: "",
      });
      // console.log(this.form.contributor);
    },

    addIdentifier() {
      this.form.identifier.push({
        identifier_name: "",
      });
      // console.log(this.form.identifier);
    },

    addSource() {
      this.form.source.push({
        source_name: "",
      });
      // console.log(this.form.source);
    },

    addCoverage() {
      this.form.coverage.push({
        coverage_name: "",
      });
      // console.log(this.form.coverage);
    },

    addDivision() {
      this.form.division_information.push({
        division_information_name: "",
      });
      // console.log(this.form.division_information);
    },

    deleteCreator(index, value) {
      this.form.creator.splice(index, 1);
    },
    deleteSubject(index, value) {
      this.form.subject.splice(index, 1);
    },
    deleteType(index, value) {
      this.form.type.splice(index, 1);
    },
    deleteFormat(index, value) {
      this.form.format.splice(index, 1);
    },
    deleteContributor(index, value) {
      this.form.contributor.splice(index, 1);
    },
    deleteIdentifier(index, value) {
      this.form.identifier.splice(index, 1);
    },
    deleteSource(index, value) {
      this.form.source.splice(index, 1);
    },
    deleteCoverage(index, value) {
      this.form.coverage.splice(index, 1);
    },
    deleteDivision(index, value) {
      this.form.division_information.splice(index, 1);
    },

    handleUploadPhoto() {
      // console.log(this.$refs.file.files);
      this.form.file_upload = this.$refs.file.files;
    },

    handleSubmit() {
      this.submitted = true;
      var vm = this;
      this.$v.$touch();
      // console.log(this.$v);
      if (this.$v.$invalid) {
        return;
      }
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
      // formData.append(
      //   "division_information",
      //   JSON.stringify(this.form.division_information)
      // );
      for (const i of Object.keys(this.form.file_upload)) {
        let is_private = this.form.is_private[i] == undefined ? 0 : 1;
        formData.append(`file_upload[${i}]`, this.form.file_upload[i]);
        formData.append(`is_private[${i}]`, is_private);
      }
      //         // <!-- WE APPEND THE AVATAR TO THE FORMDATA WE'RE GONNA POST -->
      //         for (var i = 0; i < this.form.file_upload.length; i++) {
      //         formData.append(`file_upload[${i}]`, this.form.file_upload[i]);
      //         console.log(this.form.file_upload[i]);
      // }

      // for (const i of Object.keys(this.form.file_upload)) {
      //   formData.append(`file_upload[${i}]`, this.form.file_upload[i]);
      // }
      // console.log(...formData);

      formData.append("user_id", this.form.user_id);
      formData.append("right_management", this.form.right_management);
      formData.append("upload_for", this.userdata.role);

      if (this.sameTitle) {
        Vue.swal({
          icon: "warning",
          title:
            "Submission with title " +
            this.capFLetter(this.form.title) +
            " is exist!",
          text:
            "We detected data similarities between your input and an existing submission.",
        });
      }
      else if (this.wrongFile)
      {
        Vue.swal({
          icon: "warning",
          title: "Format File Tidak Didukung!",
          text: "Perhatikan kembali format file yang akan diupload",
        });
      }
      else {
      axios
        .post("/api/upload-form", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          this.loading = false;
          // this.resetData();
          Vue.swal({
            icon: "success",
            title: "Successfully Uploaded!",
          });
          vm.$router.push("/all-deposit");
          // console.log(res);
        });
      }
    },
  },
};
</script>

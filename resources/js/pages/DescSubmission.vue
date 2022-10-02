<template>
<div class="jumbotron">
  <div class="container">

    <div class="row">
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-body p-4">
            <div>
              <nav class="navbar-light bg-light mb-2" 
                    style="padding-left:15px; padding-right:15px; padding-top:5px;">
                <div class="row">
                  <div class="col-md-12">
                    <a class="navbar-brand title-text" 
                        v-on:click.prevent="onMenuClick('cont_guide')"
                        style="cursor: pointer; width:100%;">
                      &nbsp; <i class="fa fa-address-book small"></i> &nbsp; Content Guideline
                    </a>
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
                        v-on:click.prevent="how_submit = !how_submit"
                        style="cursor: pointer; width:100%;">
                      &nbsp; <i class="fa fa-question-circle small"></i> &nbsp; How to Submit
                    </a>
                  </div>
                  <!-- <div class="col-md-12" v-if="v_option"> -->
                  <div class="col-md-12" v-if="how_submit">
                    <hr style="margin:8px; padding:0;">
                    <ul style="list-style-type: circle" class="mt-2">
                      <li>
                        <p
                          class="cat"
                          style="cursor: pointer"
                          v-on:click.prevent="onMenuClick('thes_diss')"
                        >
                          Thesis & Dissertation
                        </p>
                      </li>
                      <li>
                        <p
                          class="cat"
                          style="cursor: pointer"
                          v-on:click.prevent="onMenuClick('facu_work')"
                        >
                          Faculty & Staff Work
                        </p>
                      </li>
                      <li>
                        <p
                          class="cat"
                          style="cursor: pointer"
                          v-on:click.prevent="onMenuClick('grad_work')"
                        >
                          Graduate Work (Non-thesis)
                        </p>
                      </li>
                      <li>
                        <p
                          class="cat"
                          style="cursor: pointer"
                          v-on:click.prevent="onMenuClick('ungrad_work')"
                        >
                          Undergraduate Work
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
                        v-on:click.prevent="onMenuClick('license')"
                        style="cursor: pointer; width:100%;">
                      &nbsp; <i class="fa fa-star small"></i> &nbsp; License
                    </a>
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
                        v-on:click.prevent="onMenuClick('user_guide')"
                        style="cursor: pointer; width:100%;">
                      &nbsp; <i class="fa fa-user-circle small"></i> &nbsp; User Guides
                    </a>
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
          <div class="card-body p-content" v-if="submission">
            <div>
              <h2>Submissions</h2>
              <hr><br>
              <p v-html="submissions.description"></p>

              <div class="row mt-4 mb-5">
                <div class="col-md-3">
                  <ul class="list-group">
                    <li class="list-group-item text-center">
                      <p class="cat small"
                        style="cursor: pointer; font-size: 12 px;"
                        v-on:click.prevent="onMenuClick('thes_diss')">
                        Thesis & Dissertation
                      </p>
                    </li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <ul class="list-group">
                    <li class="list-group-item text-center">
                      <p class="cat small"
                        style="cursor: pointer; font-size: 12 px;"
                        v-on:click.prevent="onMenuClick('facu_work')">
                        Faculty & Staff Work
                      </p>
                    </li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <ul class="list-group">
                    <li class="list-group-item text-center">
                      <p class="cat small"
                        style="cursor: pointer; font-size: 12 px;"
                        v-on:click.prevent="onMenuClick('grad_work')">
                        Graduate Work (Non-thesis)
                      </p>
                    </li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <ul class="list-group">
                    <li class="list-group-item text-center">
                      <p class="cat small"
                        style="cursor: pointer; font-size: 12 px;"
                        v-on:click.prevent="onMenuClick('ungrad_work')">
                        Undergraduate Work
                      </p>
                    </li>
                  </ul>
                </div>
              </div>
              
           

            </div>
          </div>
          <div class="card-body p-content" v-if="cont_guide">
            <div>
              <h2>Content Guideline</h2>
              <hr><br>
              <p>{{guidelane.description}}</p>
              <br>
              <div>
                <nav class="navbar-light bg-light mb-2" 
                      style="padding-left:15px; padding-right:15px; padding-top:5px;">
                  <div class="row">
                    <div class="col-md-12">
                      <a class="navbar-brand title-text" 
                          v-on:click.prevent="cont_guide_1 = !cont_guide_1"
                          style="cursor: pointer; width:100%;">
                        &nbsp; <i class="fa fa-caret-down"></i>&nbsp; What is 
                      </a>
                    </div>
                    <div class="col-md-12" v-if="cont_guide_1">
                      <hr style="margin:8px; padding:0;">
                      <p class="m-3">
                     {{guidelane.what_is}}</p>
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
                          v-on:click.prevent="cont_guide_2 = !cont_guide_2"
                          style="cursor: pointer; width:100%;">
                        &nbsp; <i class="fa fa-caret-down"></i>&nbsp; Where does it come from
                      </a>
                    </div>
                    <div class="col-md-12" v-if="cont_guide_2">
                      <hr style="margin:8px; padding:0;">
                      <p class="m-3">
                       {{guidelane.where_does}}</p>
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
                          v-on:click.prevent="cont_guide_3 = !cont_guide_3"
                          style="cursor: pointer; width:100%;">
                        &nbsp; <i class="fa fa-caret-down"></i>&nbsp; Why do we use it
                      </a>
                    </div>
                    <div class="col-md-12" v-if="cont_guide_3">
                      <hr style="margin:8px; padding:0;">
                      <p class="m-3">
                      {{guidelane.why_do_we_use_it}}</p>
                    </div>    
                  </div>
                </nav>
              </div>
            </div>
          </div>
          <div class="card-body p-content" v-if="thes_diss">
            <div>
              <h2>Thesis and Dissertation</h2>
                <hr><br>
             <p v-html="how_to_submit.thesis"></p>
          

            </div>
          </div>
          <div class="card-body p-content" v-if="facu_work">
            <div>
                     <h2>Faculty & Staff work</h2>
              <hr><br>
            <p v-html="how_to_submit.faculty_work"></p>

            </div>
          </div>
          <div class="card-body p-content" v-if="grad_work">
            <div>
              <h2>Graduate Work (Non-thesis)</h2>
              <hr><br>
             <p v-html="how_to_submit.graduate_work"></p>

            </div>
          </div>
          <div class="card-body p-content" v-if="ungrad_work">
            <div>
              <h2>Undergraduate Work</h2>
              <hr><br>
             <p v-html="how_to_submit.undergrated_work"></p>

            </div>
          </div>
          <div class="card-body p-content" v-if="license">
            <div>
              <h2>License</h2>
              <hr><br>
           <p v-html="license_data"> </p>

            </div>
          </div>
          <div class="card-body p-content" v-if="user_guide">
            <div>
              <h2>User Guides</h2>
              <hr><br>
            <p v-html="user_guide_data"></p>

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
  border-radius: 0.7rem !important;
}

.p-content {
  padding: 40px;
}

a {
  font-size: 17px;
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
export default {
  data() {
    return {
      submissions : {
        description : '',
      },
      guidelane: {
        description: null,
        what_is: null,
        where_does: null,
        why_do_we_use_it: null,
      },
      how_to_submit: {
        thesis: null,
        faculty_work: null,
        graduate_work: null,
        undergrated_work: null,
      },
      license_data: null,
      loading: false,
      submission: true,
      cont_guide: false,
      how_submit: true,
      thes_diss: false,
      facu_work: false,
      grad_work: false,
      ungrad_work: false,
      license: false,
      user_guide: false,
      user_guide_data: null,

      cont_guide_1: true,
      cont_guide_2: false,
      cont_guide_3: false,
    };
  },
  components: {},
  created() {
    this.getDataGuideLane(1);
    this.getDataGuideLane(2);
    this.getDataGuideLane(3);
    this.getDataGuideLane(4);
    this.getDataHowSubmit(1);
    this.getDataHowSubmit(2);
    this.getDataHowSubmit(3);
    this.getDataHowSubmit(4);
    this.getLicense();
    this.getUserGuide();
    this.getSubmissionDescription();
  },
  methods: {
    getSubmissionDescription() {
      // api/template/submission
      axios.get('/api/template/submission')
      .then(response => {
        this.submissions.description = response.data.data.content;
      })
      .catch(error => {
        console.log(error);
      });
    },
    getUserGuide() {
      axios.get('/api/template/user-guide')
      .then(response => {
        this.user_guide_data = response.data.data.content;
      })
      .catch(error => {
        console.log(error);
      });
    },
    getLicense() {
      axios.get('/api/template/license/1')
        .then(response => {
          this.license_data = response.data.data.content;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getDataGuideLane(contentId) {
      axios
        .get(`/api/template/content-guidelane/${contentId}`)
        .then((response) => {
          switch (contentId) {
            case 1:
              this.guidelane.description = response.data.data.content;
              break;

            case 2:
              this.guidelane.what_is = response.data.data.content;
              break;

            case 3:
              this.guidelane.where_does = response.data.data.content;

              break;

            default:
              this.guidelane.why_do_we_use_it = response.data.data.content;

              break;
          }
        });
    },
    getDataHowSubmit(contentId) {
      axios.get(`/api/template/how-submit/${contentId}`).then((response) => {
        switch (contentId) {
          case 1:
            this.how_to_submit.thesis = response.data.data.content;
            break;

          case 2:
            this.how_to_submit.faculty_work = response.data.data.content;
            break;

          case 3:
            this.how_to_submit.graduate_work = response.data.data.content;

            break;

          default:
            this.how_to_submit.undergrated_work = response.data.data.content;

            break;
        }
      });
    },
    onMenuClick(mode) {
      this.loading = true;
      switch (mode) {
        case "submission":
          this.submission = true;
          this.cont_guide = false;
          this.thes_diss = false;
          this.facu_work = false;
          this.grad_work = false;
          this.ungrad_work = false;
          this.license = false;
          this.user_guide = false;
          break;

        case "cont_guide":
          this.submission = false;
          this.cont_guide = true;
          this.thes_diss = false;
          this.facu_work = false;
          this.grad_work = false;
          this.ungrad_work = false;
          this.license = false;
          this.user_guide = false;
          break;

        case "thes_diss":
          this.submission = false;
          this.cont_guide = false;
          this.thes_diss = true;
          this.facu_work = false;
          this.grad_work = false;
          this.ungrad_work = false;
          this.license = false;
          this.user_guide = false;
          break;

        case "facu_work":
          this.submission = false;
          this.cont_guide = false;
          this.thes_diss = false;
          this.facu_work = true;
          this.grad_work = false;
          this.ungrad_work = false;
          this.license = false;
          this.user_guide = false;
          break;

        case "grad_work":
          this.submission = false;
          this.cont_guide = false;
          this.thes_diss = false;
          this.facu_work = false;
          this.grad_work = true;
          this.ungrad_work = false;
          this.license = false;
          this.user_guide = false;
          break;

        case "ungrad_work":
          this.submission = false;
          this.cont_guide = false;
          this.thes_diss = false;
          this.facu_work = false;
          this.grad_work = false;
          this.ungrad_work = true;
          this.license = false;
          this.user_guide = false;
          break;

        case "license":
          this.submission = false;
          this.cont_guide = false;
          this.thes_diss = false;
          this.facu_work = false;
          this.grad_work = false;
          this.ungrad_work = false;
          this.license = true;
          this.user_guide = false;
          break;

        case "user_guide":
          this.submission = false;
          this.cont_guide = false;
          this.thes_diss = false;
          this.facu_work = false;
          this.grad_work = false;
          this.ungrad_work = false;
          this.license = false;
          this.user_guide = true;
          break;
      }
      setTimeout(() => (this.loading = false), 300);
    },
  },
};
</script>

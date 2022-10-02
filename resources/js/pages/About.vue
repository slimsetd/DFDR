<template>
  <div class="jumbotron">
    <div class="container-fluid">
      <section id="tabs">
        <div class="card p-4">
          <div class="card-body">
            <div class="container mt-4">
              <h6 class="section-title h1 text-center">About Us</h6>
              <div class="row">
                <div class="col-xs-12">
                  <nav>
                    <div
                      class="nav nav-tabs nav-fill"
                      id="nav-tab"
                      role="tablist"
                    >
                      <a
                        class="nav-item nav-link active"
                        id="nav-home-tab"
                        data-toggle="tab"
                        href="#nav-home"
                        role="tab"
                        aria-controls="nav-home"
                        aria-selected="true"
                        >What is <p v-html="header"></p>?</a
                      >
                      <a
                        class="nav-item nav-link"
                        id="nav-profile-tab"
                        data-toggle="tab"
                        href="#nav-profile"
                        role="tab"
                        aria-controls="nav-profile"
                        aria-selected="false"
                        >Why use <p v-html="header"></p>?</a
                      >
                      <a
                        class="nav-item nav-link"
                        id="nav-contact-tab"
                        data-toggle="tab"
                        href="#nav-contact"
                        role="tab"
                        aria-controls="nav-contact"
                        aria-selected="false"
                        ><p v-html="header"></p> Service Offerings</a
                      >
                    </div>
                  </nav>
                  <div
                    class="tab-content py-3 px-3 px-sm-0"
                    id="nav-tabContent"
                  >
                    <div
                      class="tab-pane fade show active"
                      id="nav-home"
                      role="tabpanel"
                      aria-labelledby="nav-home-tab"
                    >
                    <p v-html="what_is"></p>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="nav-profile"
                      role="tabpanel"
                      aria-labelledby="nav-profile-tab"
                    >
                     <p v-html="why_we_use"></p>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="nav-contact"
                      role="tabpanel"
                      aria-labelledby="nav-contact-tab"
                    >
                    <p v-html="service_offering"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>
<script>
export default {
  name: "AboutComponent",
  data() {
    return {
      what_is: null,
      why_we_use: null,
      service_offering: null,
      header: null,
      description: null,
    };
  },
  methods: {
    getHeader() {
      axios.get("/api/template/home/1").then((response) => {
        this.header = response.data.data.content;
      });
    },
    getDescription() {
      axios.get("/api/template/home/2").then((response) => {
        this.description = response.data.data.content;
      });
    },
    getAboutUs(contentId) {
      axios.get(`/api/template/about-us/${contentId}`).then((response) => {
        switch (contentId) {
          case 1:
            this.what_is = response.data.data.content;
            break;
          case 2:
            this.why_we_use = response.data.data.content;
            break;
          case 3:
            this.service_offering = response.data.data.content;
            break;

          default:
            break;
        }
      });
    },
  },
  created() {
    this.getHeader();
    this.getAboutUs(1);
    this.getAboutUs(2);
    this.getAboutUs(3);
  },
};
</script>

<style scoped>
.card {
  box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
  border-radius: 1rem !important;
}

section .section-title {
  text-align: start;
  color: #007b5e;
  margin-bottom: 50px;
  /* text-transform: uppercase; */
}
.active {
  font-weight: normal !important;
}
#tabs {
  /* background: #007b5e; */
  color: #2f3542;
}
#tabs h6.section-title {
  color: #2f3542;
}

#tabs .nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link.active {
  color: #184d47;
  background-color: transparent;
  border-color: transparent transparent #184d47;
  border-bottom: 4px solid !important;
  font-size: 20px;
  font-weight: bold;
}
#tabs .nav-tabs .nav-link {
  border: 1px solid transparent;
  border-top-left-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
  color: #2f3542;
  font-size: 20px;
}
</style>

<template>
  <div>
    <div class="container-fluid pb-0 mb-0 justify-content-center text-light ">
      <footer>
        <div class="row my-4 justify-content-center py-4">
          <div class="col-11">
            <div class="row ">
              <div class="col-xl-8 col-md-4 col-sm-4 col-12 mx-auto a">
                <h3 class="text-muted mb-md-0 mb-2 bold-text">
                 <b v-html="title"></b>
                </h3>
                <br>

                <!-- Image img-thumbnail -->
             
             
              <template v-for="(fi,i) in footerImage">
               
             

                 <img :key="i"
                  :src="getPath(fi.path)"
                  alt="."
                 
                  style="width: 34%;margin:10px 0px:padding:30px"
                />
              
           
              </template>
             
                
              </div>
              <div class="col-xl-2 col-md-4 col-sm-4 col-12">
                <h6 class="mb-3 mb-lg-4 bold-text "><b>MENU</b></h6>
                <ul class="list-unstyled">
                  <li>
                    <router-link :to="{ name: 'Homepage' }">Home</router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'DescSubmission' }">Submissions</router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'About' }">About</router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'Contact' }">Contact</router-link>
                  </li>
                </ul>
              </div>
              <div class="col-xl-2 col-md-4 col-sm-4 col-12">
                <h6 class="mb-3 mb-lg-4 text-muted bold-text mt-sm-0 mt-5">
                  <b>ADDRESS</b>
                </h6>
                <p class="mb-1" v-html="address"></p>
               
              </div>
            </div>
            <div class="row ">
              <div
                class="col-xl-8 col-md-4 col-sm-4 col-auto my-md-0 mt-5 order-sm-1 order-3 align-self-end"
              >
                <p class="social text-muted mb-0 pb-0 bold-text">
                  <span class="mx-2"
                    ><i class="fa fa-facebook" aria-hidden="true"></i
                  ></span>
                  <span class="mx-2"
                    ><i class="fa fa-linkedin-square" aria-hidden="true"></i
                  ></span>
                  <span class="mx-2"
                    ><i class="fa fa-twitter" aria-hidden="true"></i
                  ></span>
                  <span class="mx-2"
                    ><i class="fa fa-instagram" aria-hidden="true"></i
                  ></span>
                </p>
                <small class="rights"
                  ><span>&#174;</span> Framework Digital Repository All Rights Reserved.</small
                >
              </div>
            
             
                
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>
<script>
export default {
  name: 'FooterComponent',
  data() {
    return {
      emails: null,
     address: null,
     title: null,
     footerImage: null,
      // description: null
    };
  },
  methods: {
    getFooterImage(){
  axios.get('/api/template/footer-image').then(response => {
        this.footerImage = response.data.data;
      });
    },
     getPath(link) {
      var filename = link.substring(link.lastIndexOf("/") + 1);
      let file_path = "/storage/uploads/file_upload/" + filename;
      return file_path;
    },
    getAddress() {
      axios.get('/api/template/home/5').then(response => {
        this.address = response.data.data.content;
      });
    },
     getTitle() {
      axios.get('/api/template/home/1').then(response => {
        this.title = response.data.data.content;
      });
    },
      getEmails() {
      axios.get('/api/template/home/4').then(response => {
        this.emails = response.data.data;
      });
    }
  },
  created () {
    this.getFooterImage()
    this.getAddress();
    this.getTitle();
    this.getEmails();
  },
}
</script>
<style scoped>
/* @import url("https://fonts.googleapis.com/css?family=Rubik&display=swap"); */
.container-fluid {
  overflow: hidden;
  background: #2c3a47;
  color: #f5f6fa !important;
  margin-bottom: 0;
  padding-bottom: 0;
}

.container-fluid a {
  color: #f5f6fa !important;
}

small {
  font-size: calc(
    12px + (15 - 12) * ((100vw - 360px) / (1600 - 360))
  ) !important;
}

.bold-text {
  color: #f5f6fa !important;
}

.mt-55 {
  margin-top: calc(
    50px + (60 - 50) * ((100vw - 360px) / (1600 - 360))
  ) !important;
}

h3 {
  font-size: calc(
    34px + (40 - 34) * ((100vw - 360px) / (1600 - 360))
  ) !important;
}

.social {
  font-size: 21px !important;
}

.rights {
  font-size: calc(
    10px + (12 - 10) * ((100vw - 360px) / (1600 - 360))
  ) !important;
}
</style>

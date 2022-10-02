<template>
<div class="jumbotron">
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-md-6 col-sm-12 col-xs-12">
        <div
          class="card"
          style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;"
        >
          <div class="card-body">
            <h6 class="mb-3 mb-lg-4 text-muted bold-text mt-sm-0 mt-5">
              <b>ADDRESS</b>
            </h6>
            <p class="mb-1" v-html="address"></p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</template>

<script>
import pdf from "vue-pdf";
// import "pdfjs-dist/build/pdf.worker.entry";

export default {
  components: {
    pdf,
  },
 
  data() {
    return {
      address: null,
    }
  },
   created () {
    this.getContact(1);
  },
  methods: {
    getContact(contentId) {
        axios.get("/api/template/contact/" + contentId).then((response) => {
        this.address = response.data.data.content;
      });
    }
  },
};
</script>

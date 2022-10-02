<template>
  <div>
  
   
                      <pdfold :src="getSrc"></pdfold>
                  
  
  </div>
</template>

<script>
import pdfvuer from "pdfvuer";
import pdf from "vue-pdf";
// import 'pdfjs-dist/build/pdf.worker.entry' // not needed since v1.9.1

export default {
  components: {
    pdf: pdfvuer,
    pdfold: pdf,
  },
  data() {
    return {
      page: 1,
      pathFile: "",
      numPages: 0,
      pdfdata: undefined,
      errors: [],
      fileName: "",
      scale: "page-width",
    };
  },
  computed: {
    formattedZoom() {
      return Number.parseInt(this.scale * 100);
    },
    getSrc() {
      return `${this.pathFile}/${this.fileName}`;
    },
  },
  mounted() {
    this.getPdf();
  },
  created() {
    this.getPath();
    this.fileName = this.$route.params.id;
    console.log(this.$route.params.id);
  },
  watch: {
    show: function (s) {
      if (s) {
        this.getPdf();
      }
    },
    page: function (p) {
      if (
        window.pageYOffset <= this.findPos(document.getElementById(p)) ||
        (document.getElementById(p + 1) &&
          window.pageYOffset >= this.findPos(document.getElementById(p + 1)))
      ) {
        // window.scrollTo(0,this.findPos(document.getElementById(p)));
        document.getElementById(p).scrollIntoView();
      }
    },
  },
  methods: {
    getPath() {
      axios.get("/api/template/get-path").then((response) => {
        this.pathFile = response.data.data.path;
        this.getPdf(`${this.pathFile}/${this.fileName}`);
      });
    },
    handle_pdf_link: function (params) {
      // Scroll to the appropriate place on our page - the Y component of
      // params.destArray * (div height / ???), from the bottom of the page div
      var page = document.getElementById(String(params.pageNumber));
      page.scrollIntoView();
    },
    getPdf(link) {
      console.log(link);
      var self = this;
      self.pdfdata = pdfvuer.createLoadingTask(link);
      self.pdfdata.then((pdf) => {
        self.numPages = pdf.numPages;
        window.onscroll = function () {
          changePage();
          stickyNav();
        };

        // Get the offset position of the navbar
        var sticky = $("#buttons")[0].offsetTop;

        // Add the sticky class to the self.$refs.nav when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function stickyNav() {
          if (window.pageYOffset >= sticky) {
            $("#buttons")[0].classList.remove("hidden");
          } else {
            $("#buttons")[0].classList.add("hidden");
          }
        }

        function changePage() {
          var i = 1,
            count = Number(pdf.numPages);
          do {
            if (
              window.pageYOffset >= self.findPos(document.getElementById(i)) &&
              window.pageYOffset <= self.findPos(document.getElementById(i + 1))
            ) {
              self.page = i;
            }
            i++;
          } while (i < count);
          if (window.pageYOffset >= self.findPos(document.getElementById(i))) {
            self.page = i;
          }
        }
      });
    },
    findPos(obj) {
      return obj.offsetTop;
    },
  },
};
</script>
<style src="pdfvuer/dist/pdfvuer.css"></style>
<style lang="css" scoped>
#buttons {
  margin-left: 0 !important;
  margin-right: 0 !important;
}
/* Page content */
.content {
  padding: 16px;
}
</style>

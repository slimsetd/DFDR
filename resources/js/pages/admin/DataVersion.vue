<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Digital Repository Version List</h1>
    </div>
    <div class="row">
      <div class="col-md-9">

        <div class="mt-4">
          <div class="card shadow mb-3" v-for="(cat, c) in type" :key="c">
              <!-- Card Header - Accordion -->
              <a :href="'#col-ver'+ c" class="d-block card-header py-3" data-toggle="collapse"
                  role="button" aria-expanded="true" :aria-controls="'col-ver'+ c">
                  <h6 class="m-0 font-weight-bold text-primary">Digital Repository - {{ cat.version }}</h6>
              </a>
              <!-- Card Content - Collapse -->
              <div :class="'collapse p-3 ' + (c==0?'show':'')" :id="'col-ver'+ c">
                  <div class="card-body" v-html="cat.version_detail"></div>
              </div>
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

      type: [],
    };
  },
  computed: {
    rows() {},
    categories() {},
  },
  mounted() {
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }

    // this.getType();    
    this.getVersion();
  },
  methods: {

    // getType() {
    //   axios.get("/api/list/data/type").then((res) => {
    //     // console.log(res.data.data.data);
    //     // this.type = res.data.data.data;
    //     // console.log(this.type);
    //   });
    // },

    getVersion() {
      axios.get("/api/list/data/version").then((res) => {
        // console.log(res.data.data);
        this.type = res.data.data.data;
        // console.log(this.type);
      });
    },
  },
};
</script>

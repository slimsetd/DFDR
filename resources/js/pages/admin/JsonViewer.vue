<template>
  <div>
  
    <p class="m-6">Link File  : <a :href="baseUrl" target="_blank" rel="noopener noreferrer">{{baseUrl}}</a></p>
    <json-viewer
      :value="jsonData"
      :expand-depth="20"
      copyable
      expanded
    ></json-viewer>
  </div>
</template>

<script>
import JsonViewer from "vue-json-viewer";

export default {
  components: { JsonViewer },
  data() {
    return {
      baseUrl: '',
      jsonId: "",
      jsonData: {},
    };
  },
  created() {
    //   this.jsonId = this.$route.params.id;
    this.getJson(this.$route.params.id);
    // this.jsonData = this.$store.state.json;

    //   console.log(this.$router.query);
    //   console.log(this.$router.params);
  },
  methods: {
    getJson(jsonId) {
    this.baseUrl = window.location.origin + `/api/pdf/deposit/${jsonId}/report`;

      //   /pdf/deposit/{id}/report/
      axios.get(`/api/pdf/deposit/${jsonId}/report`).then((res) => {
        this.jsonData = res.data.data;
      });
    },
  },
};
</script>

<style></style>

<template>
  <div></div>
</template>

<script>
export default {
  data() {
    return {
      subject: [],
      type: [],
      form: {
        category: "",
        search: "",
      },
    };
  },
  computed: {
    categories() {
      return this.$store.getters.getAllCategories;
    },
  },
  mounted() {
    this.$store.dispatch("getCategory");
    this.getSubject();
    this.getType();
  },
  methods: {
    onSearch() {
      console.log("lore");
    },
    getSubject() {
      axios.get("/api/list/data/subject").then((res) => {
        this.subject = res.data.data.data;
        console.log(this.subject);
      });
    },

    getType() {
      axios.get("/api/list/data/type").then((res) => {
        console.log(res);
        this.type = res.data.data.data;
        console.log(this.type);
      });
    },
  },
};
</script>

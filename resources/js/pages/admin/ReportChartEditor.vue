<template>
<div class="row mb-5">
  <div class="col-sm-12">
    <h3>Deposit by Editor</h3>
    <div class="card">
      <div class="card-body m-3">
        <bar-chart-editor style="height: 400px;"></bar-chart-editor>
      </div>
    </div>
  </div>
</div>
</template>

<script>
// import barChartCategory from "../../components/barChartCategory.vue";
import barChartEditor from "../../components/barChartEditor.vue";

export default {
  components: {
    // barChartCategory,
    barChartEditor,
  },
};
</script>

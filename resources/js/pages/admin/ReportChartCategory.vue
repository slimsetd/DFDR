<template>
<div class="row mb-5">
  <div class="col-sm-6">
    <h3>Deposit by Category</h3>
    <div class="card">
      <div class="card-body">
        <bar-chart-category style="height: 300px;"></bar-chart-category>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <h3>Deposit by Year</h3>
    <div class="card">
      <div class="card-body">
        <bar-chart-year style="height: 300px;"></bar-chart-year>
      </div>
    </div>
  </div>
  <div class="col-md-12 mt-4">
    <h3>Deposit by Faculty</h3>
    <div class="card">
      <div class="card-body">
        <bar-chart-faculty style="height: 400px;"></bar-chart-faculty>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import barChartCategory from "../../components/barChartCategory.vue";
import barChartFaculty from "../../components/barChartFaculty.vue";
import barChartYear from "../../components/barChartYear.vue";

export default {
  components: {
    barChartCategory,
    barChartFaculty,
    barChartYear,
  },
};
</script>

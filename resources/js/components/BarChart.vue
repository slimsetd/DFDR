<script>
import { Line, mixins } from "vue-chartjs";
const { reactiveProp } = mixins;
export default {
  extends: Line,
  mixins: [reactiveProp],
  props: ["options"],

  mounted() {
    console.log(" date" + this.startDate);
    this.renderChart(this.chartData, this.options);
    // let uri = "http://localhost:8000/coins";
  },
};
</script>

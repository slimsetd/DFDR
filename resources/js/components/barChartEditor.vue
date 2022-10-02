<script>
import { Bar } from "vue-chartjs";

export default {
  extends: Bar,
  mounted() {
    axios
      .get("/api/list/report/deposit/chart/bar/editor")
      .then((response) => {
        console.log(response.data.data);
        let category = new Array();
        // let color = new Array();
        let dataChart = new Array();
        let data = response.data.data.chart_data.editor;
        // let datasetData = [];
        data.forEach((element) => {
          category.push(element.name);
          dataChart.push(element.total);
          // color.push(element.rgb);
        });
        
        if (data) {
          // console.log("ateng: " + category);
          // console.log("ateng::: " + dataChart);
          // console.log("ateng:::: " + color);
          this.renderChart(
            {
              labels: category,
              datasets: [
                          {
                            label: "Deposit",
                            data: dataChart,
                            backgroundColor: "#5C7AEA",
                            borderColor: "#3D56B2",
                            borderWidth: 3
                          }
                        ],
            },
            { responsive: true, maintainAspectRatio: false }
          );
        } else {
          console.log("No data");
        }
      });
  },
};
</script>

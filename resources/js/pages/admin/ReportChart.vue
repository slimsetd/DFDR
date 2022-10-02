<template>
  <div>
    <h3>Report All Deposit</h3>
    <div class="card">
      <div class="card-body">
        <div class="container">
          <form>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for=""> Start Date</label>
                  <input
                    type="date"
                    name="start_date"
                    v-model="form.start_date"
                    id="today"
                    class="form-control"
                  />
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for=""> End Date</label>
                  <input
                    type="date"
                    name="end_date"
                    v-model="form.end_date"
                    id="one_week"
                    class="form-control"
                  />
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for=""> &nbsp;</label>
                  <button
                    type="submit"
                    class="btn btn-primary btn-block"
                    v-on:click.prevent="fillData()"
                  >
                    Set Filter
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <bar-chart :chart-data="datacollection" :options="options"></bar-chart>
      </div>
    </div>
  </div>
</template>

<script>
import BarChart from "../../components/BarChart.vue";
import moment from "moment";

export default {
  components: {
    BarChart,
  },
  data() {
    return {
      today: "",
      one_week: "",
      datacollection: {},
      options: {
        responsive: true,
        maintainAspectRatio: false,
      },
      form: {
        start_date: "",
        end_date: "",
      },
      start_date: "",
      end_date: "",
      dataPost: "",
    };
  },
  mounted() {
    if (localStorage.getItem("role") == "User") {
      this.$router.push("/my-upload");
    }
    this.today = moment().format("YYYY-MM-DD");
    this.one_week = moment(this.today, "YYYY-MM-DD")
      .add(7, "days")
      .format("YYYY-MM-DD");
    this.form.start_date = this.today;
    this.form.end_date = this.one_week;
    this.fillData();
  },
  methods: {
    fillData() {
      let Labels = new Array();
      this.dataPost = {
        startDate: this.form.start_date,
        endDate: this.form.end_date,
      };
      axios
        .post("/api/list/report/deposit/chart/bar", this.dataPost)
        .then((response) => {
          console.log(response.data.data);
          let data = response.data.data.chart_data;
          if (data) {
            console.log(Labels);
            (this.datacollection = {
              labels: data.date,
              datasets: [
                {
                  label: "All Deposit",
                  data: data.totalDataAll,
                  borderColor: "rgb(78, 115, 223)",
                  fill: false,
                },
                {
                  label: "Approved",
                  data: data.totalDataApproved,
                  borderColor: "#2ecc71",
                  fill: false,
                },
                {
                  label: "Pending",
                  data: data.totalDataPending,
                  borderColor: "#f1c40f",
                  fill: false,
                },
                {
                  label: "Reject",
                  data: data.totalDataReject,
                  borderColor: "#e74c3c",
                  fill: false,
                },
              ],
            }),
              { responsive: true, maintainAspectRatio: false };
          } else {
            console.log("No data");
          }
        });
    },
  },
};
</script>

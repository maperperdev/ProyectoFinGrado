<template>
  <div>
    <div>
      <list-of-assets @change="getAssetSymbolFromChild"></list-of-assets>
      <br /><input type="date" v-model="startDate" id="startDate" required />
      <br /><input type="date" v-model="endDate" id="endDate" required />
      <br />
      <div class="error">
        {{ error }}
      </div>
    </div>

    <button
      class="px-4 py-2 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded  hover:bg-blue-500 hover:text-white hover:border-transparent"
      @click="getDataForPlot"
    >
      Ver gráfica
    </button>

    <div id="my-graph"></div>
  </div>
</template>

<script>
import * as d3 from "d3";
import axios from "axios";
import ListOfAssets from "./ListOfAssets";

export default {
  data() {
    return {
      startDate: "",
      endDate: "",
      dataArray: [],
      assetSymbol: "",
      error: "",
      isCorrect: false,
    };
  },
  components: {
    ListOfAssets,
  },
  methods: {
    formatDate(dateString) {
      let year, month, day;
      [year, month, day] = dateString.split("-").map((elem) => +elem);
      return new Date(year, month - 1, day);
    },
    getAssetSymbolFromChild(info) {
      this.assetSymbol = info;
    },
    validateRequest() {
      this.error = "";
      if (this.assetSymbol == "") {
        this.error += "Debe elegir un producto para ver su gráfica";
        console.log(this.error);
        return;
      }
      if (this.startDate == "") {
        this.error += "Debe colocar una fecha de inicio";
        console.log(this.error);
        return;
      }
      if (this.endDate == "") {
        this.error += "Debe colocar una fecha de fin";
        console.log(this.error);
        return;
      }
      let startDate = this.formatDate(this.startDate);
      let endDate = this.formatDate(this.endDate);
      if (startDate.getTime() > endDate.getTime()) {
        this.error += "La fecha de inicio es más antigua que la fecha final.";
        console.log(this.error);
        return;
      }
    },
    getDataForPlot() {
      this.validateRequest();
      if (this.error.length > 0) {
        return;
      }
      let myObj = {
        assetSymbol: this.assetSymbol,
        startDate: this.startDate,
        endDate: this.endDate,
      };
      axios
        .post("/makeChart", myObj)
        .then((response) => (this.dataArray = response.data))
        .finally(() => this.drawGraphics());
    },
    drawGraphics() {
      // const months = {
      //   0: "Jan",
      //   1: "Feb",
      //   2: "Mar",
      //   3: "Apr",
      //   4: "May",
      //   5: "Jun",
      //   6: "Jul",
      //   7: "Aug",
      //   8: "Sep",
      //   9: "Oct",
      //   10: "Nov",
      //   11: "Dec",
      // };

      var margin = { top: 10, right: 30, bottom: 30, left: 60 },
        width = 1000 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;
      var svg = d3.select("svg");
      svg.remove();
      // append the svg object to the body of the page
      svg = d3
        .select("#my-graph")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
      function parseData(d) {
        return { Date: d3.timeParse("%Y-%m-%d")(d.Date), Open: d.Open };
      }

      let data = this.dataArray.map((elem) => parseData(elem));

      /////////
      // let dates = this.dataArray.map((elem) => elem.Date);

      // var xScale = d3
      //   .scaleLinear()
      //   .domain([-1, dates.length])
      //   .range([0, width]);
      // var xDateScale = d3.scaleQuantize().domain([0, dates.length]).range(dates)
      // let xBand = d3
      //   .scaleBand()
      //   .domain(d3.range(-1, dates.length))
      //   .range([0, w])
      //   .padding(0.3)
      // var x = d3
      //   .axisBottom()
      //   .scale(xScale)
      //   .tickFormat(function (d) {
      //     d = dates[d];
      //     hours = d.getHours();
      //     minutes = (d.getMinutes() < 10 ? "0" : "") + d.getMinutes();
      //     amPM = hours < 13 ? "am" : "pm";
      //     return (
      //       hours +
      //       ":" +
      //       minutes +
      //       amPM +
      //       " " +
      //       d.getDate() +
      //       " " +
      //       months[d.getMonth()] +
      //       " " +
      //       d.getFullYear()
      //     );
      //   });

      //////////////

      var x = d3
        .scaleTime()
        .domain(
          d3.extent(data, function (d) {
            return d.Date;
          })
        )
        .range([0, width]);

      //////////////

      svg
        .append("g")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x));

      var y = d3
        .scaleLinear()
        .domain([
          0,
          d3.max(data, function (d) {
            return +d.Open;
          }),
        ])
        .range([height, 0]);
      svg.append("g").call(d3.axisLeft(y));

      svg
        .append("path")
        .datum(data)
        .attr("fill", "none")
        .attr("stroke", "steelblue")
        .attr("stroke-width", 1.5)
        .attr(
          "d",
          d3
            .line()
            .x(function (d) {
              return x(d.Date);
            })
            .y(function (d) {
              return y(d.Open);
            })
        );
      //
      svg
        .transition()
        .duration(4000)
        .delay(4000)
        .ease(d3.easeElasticOut) // Indicamos la función de transición flexible
        .style("width", "200px");
    },
  },
};
</script>

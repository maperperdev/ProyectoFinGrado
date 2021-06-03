<template>
  <div>
    <div>
      <list-of-assets @change="getAssetSymbolFromChild"></list-of-assets>
      <br /><input type="date" v-model="startDate" id="startDate" required />
      <br /><input type="date" v-model="endDate" id="endDate" required />
    </div>

    <button
      class="px-4 py-2 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded hover:bg-blue-500 hover:text-white hover:border-transparent"
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
    };
  },
  components: {
    ListOfAssets,
  },
  methods: {
    getAssetSymbolFromChild(info) {
      this.assetSymbol = info;
    },
    getDataForPlot() {
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
      console.log(data);

      var x = d3
        .scaleTime()
        .domain(
          d3.extent(data, function (d) {
            return d.Date;
          })
        )
        .range([0, width]);
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
    },
  },
};
</script>

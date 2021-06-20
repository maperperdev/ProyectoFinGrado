<template>
  <div>
    <h1 class="mb-10 text-4xl">Evolución de precio de un producto</h1>
    <div class="grid-cols-2">
      <div class="inline-block">
        <list-of-assets @change="getAssetSymbolFromChild"></list-of-assets>
        <br /><input type="date" v-model="startDate" id="startDate" required />
        <br /><input type="date" v-model="endDate" id="endDate" required />
        <br />
      </div>

      <table class="inline-block">
        <tr>
          <td>Valor máximo:</td>
          <td>{{ maxValue }}</td>
        </tr>
        <tr>
          <td>Valor mínimo:</td>
          <td>{{ minValue }}</td>
        </tr>
        <tr>
          <td>Valor medio:</td>
          <td>{{ meanValue }}</td>
        </tr>
      </table>
    </div>

    <button
      class="px-4 py-2 my-5 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded  hover:bg-blue-500 hover:text-white hover:border-transparent"
      @click="getDataForPlot"
    >
      Ver gráfica
    </button>

    <div class="text-lg text-red-600">
      {{ error }}
    </div>
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
      meanValue: "",
      maxValue: "",
      minValue: "",
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
        return;
      }
      if (this.startDate == "") {
        this.error += "Debe colocar una fecha de inicio";
        return;
      }
      if (this.endDate == "") {
        this.error += "Debe colocar una fecha de fin";
        return;
      }
      let startDate = this.formatDate(this.startDate);
      let endDate = this.formatDate(this.endDate);
      if (startDate.getTime() > endDate.getTime()) {
        this.error += "La fecha de inicio es más antigua que la fecha final.";
        return;
      }
      let today = new Date();
      if (endDate.getTime() > today.getTime()) {
        this.error += "La fecha de fin no puede ser posterior al día de hoy.";
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
        .then(console.log(this.dataArray))
        .finally(() => this.drawGraphics());
    },
    drawGraphics() {
      const localFormat = {
        decimal: ".",
        thousands: ",",
        grouping: [3],
        currency: ["$", ""],
        dateTime: "%a %b %e %X %Y",
        date: "%m/%d/%Y",
        time: "%H:%M:%S",
        periods: ["AM", "PM"],
        days: [
          "Sunday",
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
        ],
        shortDays: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        months: [
          "Enero",
          "Febrero",
          "Marzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Septiembre",
          "Octubre",
          "Noviembre",
          "Dicembre",
        ],
        shortMonths: [
          "Ene",
          "Feb",
          "Mar",
          "Abr",
          "May",
          "Jun",
          "Jul",
          "Ago",
          "Sep",
          "Oct",
          "Nov",
          "Dic",
        ],
      };
      d3.timeFormatDefaultLocale(localFormat);

      var margin = { top: 10, right: 30, bottom: 30, left: 60 },
        width = 1000 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;
      var svg = d3.select("svg");
      svg.remove();

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

      let dataPrices = data.map((elem) => +elem.Open);
      this.maxValue = Math.max.apply(null, dataPrices).toPrecision(6);
      this.minValue = Math.min.apply(null, dataPrices).toPrecision(6);
      const sumatory = (accumulator, currentValue) =>
        accumulator + currentValue;
      this.meanValue = (
        dataPrices.reduce(sumatory) / dataPrices.length
      ).toPrecision(6);

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

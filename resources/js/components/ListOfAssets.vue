<template>
  <div>
    <input
      list="companySymbols"
      name="companySymbol"
      id="companySymbol"
      placeholder="Introduce the name of a stock"
    />
    <datalist id="companySymbols">
      <option
        v-for="stock of listOfStocks"
        :key="stock"
        :id="stock.asset_symbol"
      >
        {{ stock.asset_name }}
      </option>
    </datalist>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      listOfStocks: [],
      price: "",
    };
  },
  methods: {
    getListStocks() {
      axios.get("/listOfStocks").then(
        function (promiseResponse) {
          this.listOfStocks = promiseResponse.data;
        }.bind(this)
      );
    },
  },
  mounted() {
    this.getListStocks();
  },
};
</script>
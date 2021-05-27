<template>
  <div>
    <input
      type="text"
      list="companySymbols"
      name="companySymbol"
      id="companySymbol"
      placeholder="Escriba el nombre de una acción"
      v-model="assetName"
      @change="getPrice()"
    />
    <datalist id="companySymbols">
      <option v-for="stock of listOfStocks" :key="stock.asset_symbol">
        {{ stock.asset_name }}
      </option>
    </datalist>
    <p>Precio</p>
    <input type="number" :value="fixedPrice()" readonly />
  </div>
</template>

<style scoped>
input {
  padding: 10px;
  width: 290px;
  border-radius: 10px;
}
</style>

<script>
import axios from "axios";

export default {
  data() {
    return {
      assetName: "",
      listOfStocks: [],
      price: "",
    };
  },
  computed: {
    fixedPrice() {
      return this.price.toFixed(2) + " $";
    },
  },
  methods: {
    getListStocks() {
      axios
        .get("/listOfStocks")
        .then((promiseResponse) => (this.listOfStocks = promiseResponse.data));
    },
    getStockSymbolFromAssetName() {
      return this.listOfStocks.filter(
        (elem) => elem.asset_name === this.assetName
      )[0].asset_symbol;
    },
    getPrice() {
      axios
        .post("/stocksData", {
          companySymbol: this.getStockSymbolFromAssetName(),
        })
        .then(
          (promiseResponse) =>
            (this.price = parseFloat(promiseResponse.data.price))
        );
    },
  },
  mounted() {
    this.getListStocks();
  },
};
</script>
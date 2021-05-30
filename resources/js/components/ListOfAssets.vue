<template>
  <div>
    <input
      type="text"
      list="assetSymbolList"
      name="companySymbol"
      id="companySymbol"
      :placeholder="placeholderMessage"
      v-model="assetName"
      @change="getPrice()"
    />
    <datalist id="assetSymbolList">
      <option v-for="asset of listOfAssets" :key="asset.asset_symbol">
        {{ asset.asset_name }}
      </option>
    </datalist>
    <p>Precio</p>
    <input id="price" type="number" v-model="price" readonly />
    <!-- <button @click="setPriceEvent">Enviar</button> -->
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
  props: ["selected"],
  data() {
    return {
      apiGetPriceAsset: "",
      apiListAssetURL: "",
      fixedDecimal: "",
      placeholderMessage: "",
      assetName: "",
      listOfAssets: [],
      price: "",
    };
  },
  methods: {
    getListAsset() {
      axios
        .get(this.apiListAssetURL)
        .then((promiseResponse) => (this.listOfAssets = promiseResponse.data));
    },
    getAssetSymbolFromAssetName() {
      return this.listOfAssets.filter(
        (elem) => elem.asset_name === this.assetName
      )[0].asset_symbol;
    },
    getPrice() {
      axios
        .post(this.apiGetPriceAsset, {
          assetSymbol: this.getAssetSymbolFromAssetName(),
        })
        .then(
          (promiseResponse) =>
            (this.price = parseFloat(promiseResponse.data.price).toFixed(
              this.fixedDecimal
            ))
        );
      this.setPriceEvent();
    },
    updateData() {
      if (this.selected === "Acciones") {
        this.apiListAssetURL = "/listOfStocks";
        this.fixedDecimal = 2;
        this.placeholderMessage = "Nombre de la acción";
      }
      if (this.selected === "Criptomonedas") {
        this.apiListAssetURL = "/listOfCryptos";
        this.fixedDecimal = 5;
        this.placeholderMessage = "Nombre de la criptomoneda";
      }
      this.apiGetPriceAsset = "/assetPrice";
    },
    setPriceEvent() {
      this.$emit("setprice-event", this.price);
    },
  },
  watch: {
    selected: function () {
      this.assetName = "";
      this.price = "";
      this.updateData();
      this.getListAsset();
    },
  },
  mounted() {
    this.updateData();
    this.getListAsset();
  },
};
</script>
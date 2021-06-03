<template>
  <div>
    <select v-model="selected">
      <option disabled value="">Seleccione un elemento</option>
      <option>Acciones</option>
      <option>Criptomonedas</option>
    </select>
    <input
      type="text"
      list="assetSymbolList"
      name="companySymbol"
      id="companySymbol"
      :placeholder="placeholderMessage"
      v-model="assetName"
      @change="emmitAssetSymbol"
    />
    <datalist id="assetSymbolList">
      <option v-for="asset of listOfAssets" :key="asset.asset_symbol">
        {{ asset.asset_name }}
      </option>
    </datalist>
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
  // props: ["selected"],
  data() {
    return {
      selected: "",
      apiGetPriceAsset: "",
      apiListAssetURL: "",
      fixedDecimal: "",
      placeholderMessage: "",
      assetName: "",
      assetSymbol: "",
      listOfAssets: [],
    };
  },
  methods: {
    getListAsset() {
      axios
        .get(this.apiListAssetURL)
        .then((promiseResponse) => (this.listOfAssets = promiseResponse.data));
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
    getAssetSymbol() {
      if (this.listOfAssets.length > 0) {
        for (let asset of this.listOfAssets) {
          if (asset.asset_name === this.assetName) {
            this.assetSymbol = asset.asset_symbol;
          }
        }
      }
    },
    emmitAssetSymbol() {
      this.getAssetSymbol();
      this.$emit("change", this.assetSymbol);
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
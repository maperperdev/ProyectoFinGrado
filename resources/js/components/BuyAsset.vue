<template>
  <div>
    <p>Esto es mi pagina de compra</p>
    <select v-model="selected">
      <option disabled value="">Seleccione un elemento</option>
      <option>Acciones</option>
      <option>Criptomonedas</option>
    </select>
    <br />
    <input
      type="text"
      list="assetSymbolList"
      name="companySymbol"
      id="companySymbol"
      v-if="selected != ''"
      :placeholder="placeholderMessage"
      :selected="selectedReactive"
      v-model="assetName"
      @change="getPrice()"
    />
    <br />
    <datalist id="assetSymbolList">
      <option v-for="asset of listOfAssets" :key="asset.asset_symbol">
        {{ asset.asset_name }}
      </option>
    </datalist>
    <br />
    <input id="price" type="number" v-model="price" readonly />
    <br />
    <input v-show="selected" type="number" v-model="quantity" min="0" />
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
      selected: "",
      quantity: Number,
      price: Number,
      apiGetPriceAsset: "",
      apiListAssetURL: "",
      fixedDecimal: "",
      placeholderMessage: "",
      assetName: "",
      listOfAssets: [],
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
  },
  computed: {
    selectedReactive() {
      return this.selected;
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
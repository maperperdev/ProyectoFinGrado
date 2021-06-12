<template>
  <div>
    <p>Esto es mi pagina de compra</p>
    <select v-model="selected">
      <option disabled value="">Seleccione un elemento</option>
      <option>Acciones</option>
      <option>Criptomonedas</option>
    </select>
    <br />
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
    <br />
    <datalist id="assetSymbolList">
      <option v-for="asset of listOfAssets" :key="asset.asset_symbol">
        {{ asset.asset_name }}
      </option>
    </datalist>
    <input id="price" type="number" v-model="price" readonly />
    <br />
    <br />
    <input
      v-show="selected"
      type="number"
      v-model="quantity"
      min="0"
      placeholder="Introduzca la cantidad"
    />
    <br />
    <br />

    <p>{{ totalOperationComputed }}</p>

    <button
      v-show="selected"
      @click="buyAsset()"
      class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full  hover:bg-blue-700"
    >
      Comprar
    </button>
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
      quantity: null,
      price: null,
      apiGetPriceAsset: "",
      apiListAssetURL: "",
      fixedDecimal: "",
      placeholderMessage: "",
      assetName: "",
      listOfAssets: [],
      totalOperation: null,
    };
  },
  methods: {
    buyAsset() {
      const buyObject = {
        id_asset: this.getIdAsset(),
        purchase_price: this.price,
        quantity: this.quantity,
      };
      console.log(buyObject);
      axios
        .post("/buyAsset", buyObject)
        .finally(
          alert(
            `Ha comprado ${buyObject.quantity} del producto ${this.assetName} por un precio de ${this.price}`
          )
        );
      this.clearForm();
    },
    clearForm() {
      this.assetName = "";
      this.price = "";
      this.quantity = "";
    },
    getIdAsset() {
      for (let asset of this.listOfAssets) {
        if (asset.asset_name === this.assetName) {
          return asset.id;
        }
      }
    },
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
    totalOperationComputed() {
      if (this.quantity != null) {
        return this.quantity * this.price;
      }
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
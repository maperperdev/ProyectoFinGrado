<template>
  <div>
    <div>
      <select v-model="selected">
        <option disabled value="">Seleccione un elemento</option>
        <option>Acciones</option>
        <option>Criptomonedas</option>
      </select>
    </div>

    <div v-show="selected != ''">
      <input
        type="text"
        list="assetSymbolList"
        name="companySymbol"
        id="companySymbol"
        :placeholder="placeholderMessage"
        @select="selectedReactive"
        v-model="assetName"
        @change="getPrice()"
      />
      <datalist id="assetSymbolList">
        <option v-for="asset of listOfAssets" :key="asset.asset_symbol">
          {{ asset.asset_name }}
        </option>
      </datalist>
    </div>

    <div v-show="assetName != ''">
      <input
        id="quantity"
        type="number"
        v-model="quantity"
        min="0"
        placeholder="Introduzca la cantidad"
      />
    </div>

    <div>
      <input id="price" type="number" v-model="price" readonly />
    </div>
    <br />

    <div v-show="quantity > 0">
      <table>
        <tr>
          <td>
            Total Compra: {{ quantity == "" ? "" : totalOperationComputed }}
          </td>
          <td
            :class="
              fundsAfterBuyComputed < 0
                ? 'font-bold text-red-600'
                : 'text-green-400'
            "
          >
            Saldo Disponible: {{ fundsAfterBuyComputed }}
          </td>
        </tr>
      </table>

      <button
        v-show="selected"
        @click="buyAsset"
        class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full  hover:bg-blue-700"
      >
        Comprar
      </button>
    </div>
  </div>
</template>

<style scoped>
input {
  padding: 10px;
  width: 290px;
  border-radius: 10px;
}
div {
  padding: 0.5rem;
}
</style>

<script>
import axios from "axios";

export default {
  data() {
    return {
      selected: "",
      quantity: "",
      price: null,
      apiGetPriceAsset: "",
      apiListAssetURL: "",
      fixedDecimal: "",
      placeholderMessage: "",
      assetName: "",
      listOfAssets: [],
      totalOperation: null,
      moneyAccount: "",
      fundsAfterBuy: "",
    };
  },
  methods: {
    buyAsset() {
      if (this.fundsAfterBuy < 0) {
        alert("No tiene suficientes fondos para realizar la operación");
      }
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
    getAccountMoney() {
      axios
        .get("/user/money-account", {})
        .then((promiseResponse) => (this.moneyAccount = promiseResponse.data));
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
      if (this.quantity != 0) {
        return Number.parseFloat(this.quantity * this.price).toPrecision(6);
      }
    },
    fundsAfterBuyComputed() {
      return this.quantity > 0
        ? this.moneyAccount - this.quantity * this.price
        : this.moneyAccount;
    },
  },
  watch: {
    selected: function () {
      this.assetName = "";
      this.price = "";
      this.quantity = "";
      this.updateData();
      this.getListAsset();
    },
  },
  mounted() {
    this.updateData();
    this.getAccountMoney();
    this.getListAsset();
  },
};
</script>

<style scoped>
input {
  border: 1px solid black;
}
input:active {
  border: none;
}
td {
  padding: 2rem;
}
</style>
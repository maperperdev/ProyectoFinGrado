<template>
  <div>
    <h1 class="mb-10 text-4xl">Venta de productos</h1>

    <h1 v-show="listOfUnsoldAsset.length == 0" class="mb-10 text-xl">
      No tiene productos en su cartera
    </h1>
    <div
      class="overflow-hidden border-b border-gray-200 rounded shadow"
      v-show="listOfUnsoldAsset.length > 0"
    >
      <table class="table-hover" @selectionChanged="selectedRows = $event">
        <thead class="text-white bg-gray-700" slot="head">
          <th class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase">
            Producto
          </th>
          <th class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase">
            Tipo
          </th>
          <th class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase">
            Precio de compra
          </th>
          <th class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase">
            Fecha de compra
          </th>
          <th
            class="w-1/3 px-4 py-3 text-sm font-semibold text-center uppercase"
          >
            Cantidad
          </th>
          <th class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase">
            Precio actual
          </th>
          <th></th>
        </thead>
        <tbody slot="body">
          <tr
            v-for="(row, index) in listOfUnsoldAsset"
            :key="index"
            :row="row"
            :class="index % 2 == 1 ? 'bg-gray-100' : ''"
          >
            <td>{{ row.asset_name }}</td>
            <td>
              {{ row.asset_type == 2 ? "Criptomoneda" : "Acción" }}
            </td>
            <td>{{ row.purchase_price }}</td>
            <td>{{ formatDate(row.purchase_date) }}</td>
            <td>{{ row.quantity }}</td>
            <td>{{ row.selling_price }}</td>
            <td>
              <button
                @click="confirmSelectedAsset(row, index)"
                class="px-4 py-2 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded  hover:bg-blue-500 hover:text-white hover:border-transparent"
              >
                Vender
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <confirm-modal
      v-show="confirmModal"
      modalHeadline="Vender el producto seleccionado"
      deleteMessage="¿Está seguro de la venta de ese producto?"
      @confirm="sellAsset"
      @close="close"
    >
    </confirm-modal>
  </div>
</template>

<script>
import ConfirmModal from "./ConfirmModal.vue";
import axios from "axios";

export default {
  components: {
    ConfirmModal,
  },
  name: "SellAssetTest",
  data() {
    return {
      listOfUnsoldAsset: [],
      selectedRows: [],
      index: null,
      confirmModal: false,
      id: null,
    };
  },
  methods: {
    getUnsolAsset() {
      axios
        .get("/unsoldAssetList2")
        .then((response) => (this.listOfUnsoldAsset = response.data));
    },
    confirmSelectedAsset(row, index) {
      this.confirmModal = true;
      this.id = row.id;
      this.sellingAssetConfirmed = row;
      this.index = index;
    },
    cancelSell() {
      this.sellingAssetConfirmed = null;
      this.id = null;
    },
    sellAsset() {
      let myObj = {
        id: this.id,
        quantity: this.listOfUnsoldAsset[this.index].quantity,
        selling_price: this.listOfUnsoldAsset[this.index].selling_price,
        asset_name: this.listOfUnsoldAsset[this.index].asset_name,
      };
      axios.post("/sellAsset", myObj);
      this.listOfUnsoldAsset.splice(this.index, 1);
      this.id = null;
      this.index = null;
      this.close();
    },
    formatDate(date) {
      let year, month, day;
      [year, month, day] = date.split("-");
      return `${day}-${month}-${year}`;
    },
    close() {
      this.confirmModal = false;
    },
  },
  mounted() {
    this.getUnsolAsset();
  },
};
</script>

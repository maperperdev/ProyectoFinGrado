<template>
  <div>
    <table class="table-hover" @selectionChanged="selectedRows = $event">
      <thead slot="head">
        <th>ID</th>
        <th>Asset Name</th>
        <th>Purchase Price</th>
        <th>Purchase Data</th>
        <th>Quantity</th>
        <th>Selling Price</th>
      </thead>
      <tbody slot="body">
        <tr v-for="(row, index) in listOfUnsoldAsset" :key="index" :row="row">
          <td>{{ row.id }}</td>
          <td>{{ row.asset_name }}</td>
          <td>{{ row.purchase_price }}</td>
          <td>{{ row.purchase_date }}</td>
          <td>{{ row.quantity }}</td>
          <td>{{ row.selling_price }}</td>
          <td>
            <button
              @click="sellAsset(row.id, index)"
              class="px-4 py-2 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded hover:bg-blue-500 hover:text-white hover:border-transparent"
            >
              Vender
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- <strong>Selected:</strong>
    <div v-if="selectedRows.length === 0" class="text-muted">
      No Rows Selected
    </div> -->
  </div>
</template>


<script>
import axios from "axios";
export default {
  data() {
    return {
      listOfUnsoldAsset: [],
      selectedRows: [],
    };
  },
  methods: {
    getUnsolAsset() {
      axios
        .get("/unsoldAssetList2")
        .then((response) => (this.listOfUnsoldAsset = response.data));
    },
    addFieldToList() {
      for (let asset of this.listOfUnsoldAsset) {
        console.log(asset);
      }
    },
    sellAsset(id, index) {
      let myObj = {
        id: id,
        quantity: this.listOfUnsoldAsset[index].quantity,
        selling_price: this.listOfUnsoldAsset[index].selling_price,
        asset_name: this.listOfUnsoldAsset[index].asset_name,
      };
      axios
        .post("/sellAsset", myObj)
        .finally(
          alert(
            `Ha vendido ${myObj.quantity} del producto ${myObj.assetName} por un precio de ${myObj.selling_price}`
          )
        );
      this.listOfUnsoldAsset.splice(index, 1);
    },
  },

  mounted() {
    this.getUnsolAsset();
    this.addFieldToList();
  },
};
</script>
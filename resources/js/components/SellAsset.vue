<template>
    <div>
        <h1 class="text-4xl mb-10">Venta de productos</h1>
        <div
            class="overflow-hidden border-b border-gray-200 rounded shadow"
            v-show="listOfUnsoldAsset.length > 0"
        >
            <table
                class="table-hover"
                @selectionChanged="selectedRows = $event"
            >
                <thead class="text-white bg-gray-800" slot="head">
                    <th
                        class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
                    >
                        Id
                    </th>
                    <th
                        class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
                    >
                        Producto
                    </th>
                    <th
                        class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
                    >
                        Tipo
                    </th>
                    <th
                        class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
                    >
                        Precio de compra
                    </th>
                    <th
                        class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
                    >
                        Fecha de compra
                    </th>
                    <th
                        class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
                    >
                        Cantidad
                    </th>
                    <th
                        class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
                    >
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
                        <td>{{ row.id }}</td>
                        <td>{{ row.asset_name }}</td>
                        <td>
                            {{
                                row.asset_type == 2 ? "Criptomoneda" : "Acción"
                            }}
                        </td>
                        <td>{{ row.purchase_price }}</td>
                        <td>{{ row.purchase_date }}</td>
                        <td>{{ row.quantity }}</td>
                        <td>{{ row.selling_price }}</td>
                        <td>
                            <button
                                @click="sellAsset(row.id, index)"
                                class="px-4 py-2 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded  hover:bg-blue-500 hover:text-white hover:border-transparent"
                            >
                                Vender
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <vue-modal-2
            name="modal-1"
            :headerOptions="{
                title: 'Realizar venta'
            }"
            @on-close="close"
            :footerOptions="{
                disableBtn2: true,
                btn2Style: {
                  display: 'hidden'
                },
                btn1: 'Aceptar',
                btn1Style: {
                    backgroundColor: 'blue',
                    color: 'white'
                },
                btn1OnClick: () => {
                    $vm2.close('modal-1');
                }
            }"
        >
            <div class="px-7">
                Ha vendido satisfactoriamente el producto.
            </div>
        </vue-modal-2>
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
            selectedRows: []
        };
    },
    methods: {
        getUnsolAsset() {
            axios
                .get("/unsoldAssetList2")
                .then(response => (this.listOfUnsoldAsset = response.data));
        },
        sellAsset(id, index) {
            let myObj = {
                id: id,
                quantity: this.listOfUnsoldAsset[index].quantity,
                selling_price: this.listOfUnsoldAsset[index].selling_price,
                asset_name: this.listOfUnsoldAsset[index].asset_name
            };
            axios.post("/sellAsset", myObj).finally(this.open());
            this.listOfUnsoldAsset.splice(index, 1);
        },
        open() {
            this.$vm2.open("modal-1");
        },
        close() {
            this.$vm2.close("modal-1");
        }
    },

    mounted() {
        this.getUnsolAsset();
    }
};
</script>

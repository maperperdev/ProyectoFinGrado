<template>
    <div>
        <h1 class="text-4xl mb-10">Información de su cuenta</h1>
        <input
            type="number"
            v-model="addedMoney"
            name="moneyAccount"
            id=""
            style="width: 30rem"
            placeholder="Introduzca la cantidad que vaya a ingresar"
            min="0"
        />

        <button
            @click="addFunds"
            class="px-4 py-2 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded  hover:bg-blue-500 hover:text-white hover:border-transparent"
        >
            Agregar fondos
        </button>
        <p>Beneficio: <span :class="profit > 0 ? 'text-green-600' : 'text-red-600'">{{ profit }}</span></p>
        <p>Cuenta corriente: <span>{{ moneyAccountValue}}</span></p>

        <div v-show="account.length > 0" class="w-full py-8 md:px-32">
            <input class="w-1/2 h-12 px-4 mb-2 text-lg text-gray-700 placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" v-model="filters.assetName.value" placeholder="Filtrar por producto" />
            <br>
            <div
                class="overflow-hidden border-b border-gray-200 rounded shadow"
            >
                <v-table
                    :data="account"
                    :filters="filters"
                    :currentPage.sync="currentPage"
                    :pageSize="3"
                    @totalPagesChanged="totalPages = $event"
                >
                    <thead slot="head" class="text-white bg-gray-800">
                        <v-th
                            class="px-4 py-3 text-sm font-semibold text-left uppercase "
                            sortKey="assetName"
                            defaultSort="desc"
                        >
                            Nombre producto
                        </v-th>
                        <v-th
                            class="px-4 py-3 text-sm font-semibold text-left uppercase "
                            sortKey="assetType"
                            defaultSort="desc"
                        >
                            Tipo de producto
                        </v-th>
                        <v-th
                            class="px-4 py-3 text-sm font-semibold text-left uppercase "
                            sortKey="purchasePrice"
                            defaultSort="desc"
                        >
                            Precio de compra
                        </v-th>
                        <v-th
                            class="px-4 py-3 text-sm font-semibold text-left uppercase "
                            sortKey="purchaseDate"
                            defaultSort="desc"
                        >
                            Fecha de compra
                        </v-th>
                        <v-th
                            class="px-4 py-3 text-sm font-semibold text-left uppercase "
                            sortKey="quantity"
                            defaultSort="desc"
                        >
                            Cantidad
                        </v-th>
                        <v-th
                            class="px-4 py-3 text-sm font-semibold text-left uppercase"
                            sortKey="sellingPrice"
                            defaultSort="desc"
                        >
                            Precio de venta
                        </v-th>
                        <v-th
                            class="px-4 py-3 text-sm font-semibold text-left uppercase"
                            sortKey="sellingDate"
                            defaultSort="desc"
                        >
                            Fecha de venta
                        </v-th>
                    </thead>
                    <tbody
                        slot="body"
                        slot-scope="{ displayData }"
                        class="text-gray-700"
                    >
                        <tr
                            v-for="(elem, index) in displayData"
                            :key="index"
                            :class="index % 2 == 1 ? 'bg-gray-100' : ''"
                        >
                            <td class="w-1/3 px-4 py-3 text-left">
                                {{ elem.assetName }}
                            </td>

                            <td class="w-1/3 px-4 py-3 text-left">
                                {{
                                    elem.assetType == 1
                                        ? "Acción"
                                        : "Criptomoneda"
                                }}
                            </td>

                            <td class="w-1/3 px-4 py-3 text-left">
                                {{ elem.purchasePrice }}
                            </td>

                            <td class="w-1/3 px-4 py-3 text-left">
                                {{ elem.purchaseDate }}
                            </td>

                            <td class="w-1/3 px-4 py-3 text-left">
                                {{ elem.quantity }}
                            </td>

                            <td class="px-4 py-3 text-left">
                                {{ elem.sellingPrice }}
                            </td>
                            <td class="px-4 py-3 text-left">
                                {{ elem.sellingDate }}
                            </td>
                        </tr>
                    </tbody>
                </v-table>
                <smart-pagination
                    :currentPage.sync="currentPage"
                    :totalPages="totalPages"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            moneyAccount: 0,
            account: [],
            addedMoney: null,
            visible: true,
            isFilled: false,
            profit: 0,
            filters: {
                assetName: { value: "", keys: ["assetName"] }
            },
            currentPage: 1,
            totalPages: 0
        };
    },
    methods: {
        addFunds() {
            axios
                .post("/user/add-money", { money: this.addedMoney })
                .then(
                    (this.moneyAccount = +this.addedMoney + this.moneyAccount)
                )
                .finally((this.addedMoney = ""));
        },
        getAccount() {
            axios
                .post("/getAccountValue", {})
                .then(promiseResponse => (this.account = promiseResponse.data))
        },
        getMoneyAccount() {
            axios
                .get("/user/money-account")
                .then(response => (this.moneyAccount = response.data))
        },
        getProfit() {
            axios.get('/getProfit')
                .then((response) => this.profit = response.data)
        },
        localDateFormat(date) {
            let [year, month, day] = date.split('-');
            return `${day}-${month}-${year}`;
        }
    },
    computed: {
        moneyAccountValue() {
            return this.moneyAccount;
        }
    },
    mounted() {
        this.getMoneyAccount();
        this.getProfit();
        this.getAccount();
    }
};
</script>

<style>
.pagination {
    border-radius: 25%;
    list-style: none;
    display: inline-block;
}
.page-item {
    float: left;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
}
</style>

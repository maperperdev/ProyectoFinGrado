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
    <input
      readonly
      :value="moneyAccountValue"
      type="text"
      disabled
      class="flex flex-row-reverse border-gray-500 border-solid"
    />

    <hr />
    <br />
    <button
      class="px-4 py-2 font-semibold text-center text-blue-700 bg-transparent border border-blue-500 rounded  hover:bg-blue-500 hover:text-white hover:border-transparent"
      @click="getAccount()"
      v-show="visible"
    >
      Ver portfolio
    </button>
    <div v-if="account.length > 0" class="w-full py-8 md:px-32">
      <div class="overflow-hidden border-b border-gray-200 rounded shadow">
        <table class="min-w-full bg-white">
          <thead class="text-white bg-gray-800">
            <tr>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase "
              >
                Nombre producto
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase "
              >
                Tipo de producto
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase "
              >
                Precio de compra
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase "
              >
                Fecha de compra
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase "
              >
                Cantidad
              </th>
              <th class="px-4 py-3 text-sm font-semibold text-left uppercase">
                Precio de venta
              </th>
              <th class="px-4 py-3 text-sm font-semibold text-left uppercase">
                Fecha de venta
              </th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            <tr
              v-for="(elem, index) in displayedPosts"
              :key="index"
              :class="index % 2 == 1 ? 'bg-gray-100' : ''"
            >
              <td class="w-1/3 px-4 py-3 text-left">
                {{ elem.assetName }}
              </td>

              <td class="w-1/3 px-4 py-3 text-left">
                {{ elem.assetType == 1 ? 'Acción' : 'Criptomoneda' }}
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
        </table>

        <nav aria-label="Page navigation example" class="block">
          <ul class="list-none rounded">
            <li class="inline-block">
              <button type="button" v-if="page != 1" @click="page--">
                Atrás
              </button>
            </li>
            <li
              class="inline-block"
              v-for="pageNumber in pages.slice(page - 1, page + 5)"
              :key="pageNumber"
            >
              <button
                type="button"
                class="relative flex items-center justify-center w-8 h-8 p-0 mx-1 text-xs font-semibold leading-tight text-teal-500 bg-white border border-teal-500 border-solid rounded-full  first:ml-0"
                @click="page = pageNumber"
              >
                {{ pageNumber }}
              </button>
            </li>
            <li class="inline-block">
              <button type="button" @click="page++" v-if="page < pages.length">
                Siguiente
              </button>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <div v-show="isFilled">No tiene compras realizadas</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      idUser: "",
      moneyAccount: 0,
      page: 1,
      perPage: 4,
      addedMoney: null,
      account: [],
      pages: [],
      visible: true,
      isFilled: false,
    };
  },
  methods: {
    addFunds() {
      axios
        .post("/user/add-money", { money: this.addedMoney })
        .then((this.moneyAccount = +this.addedMoney + this.moneyAccount))
        .finally((this.addedMoney = 0));
    },
    getAccount() {
      axios
        .post("/getAccountValue", {
          id_user: this.idUser,
        })
        .then((promiseResponse) => (this.account = promiseResponse.data));
    },
    getIdUser() {
      axios
        .get("/user/id")
        .then((promiseResponse) => (this.idUser = promiseResponse.data));
    },
    getMoneyAccount() {
      axios
        .get("/user/money-account")
        .then((response) => (this.moneyAccount = response.data))
        .finally((data) => console.log(data));
      this.isFilled = this.moneyAccount.length == 0;
    },
    setPages() {
      let numberOfPages = Math.ceil(this.account.length / this.perPage);
      for (let index = 1; index <= numberOfPages; index++) {
        this.pages.push(index);
      }
    },
    paginate(posts) {
      let page = this.page;
      let perPage = this.perPage;
      let from = page * perPage - perPage;
      let to = page * perPage;
      return posts.slice(from, to);
    },
  },
  computed: {
    displayedPosts() {
      return this.paginate(this.account);
    },
    moneyAccountValue() {
      return this.moneyAccount;
    },
  },
  watch: {
    account() {
      this.setPages();
    },
  },
  mounted() {
    this.getIdUser();
    this.getAccount();
    this.getMoneyAccount();
  },
};
</script>

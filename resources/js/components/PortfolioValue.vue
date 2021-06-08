<template>
  <div>
    <p>Esto es mi portfolio value Test</p>
    <input
      type="number"
      v-model="addedMoney"
      name="moneyAccount"
      id=""
      placeholder="Introduzca la cantidad que vaya a ingresar"
      min="0"
    />
    <input readonly :value="moneyAccount" type="text" disabled />
    <button
      @click="
        getAccount();
        visible = false;
      "
      v-show="visible"
    >
      Ver portfolio
    </button>

    <div v-show="account.length > 0" class="w-full py-8 md:px-32">
      <div class="overflow-hidden border-b border-gray-200 rounded shadow">
        <table class="min-w-full bg-white">
          <thead class="text-white bg-gray-800">
            <tr>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase "
              >
                Asset Name
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase "
              >
                Asset Type
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase "
              >
                Purchase Price
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase "
              >
                Purchase Date
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase "
              >
                Quantity
              </th>
              <th class="px-4 py-3 text-sm font-semibold text-left uppercase">
                Selling Price
              </th>
              <th class="px-4 py-3 text-sm font-semibold text-left uppercase">
                Selling Date
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
                {{ elem.assetType }}
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

        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <button
                type="button"
                class="page-link"
                v-if="page != 1"
                @click="page--"
              >
                Atrás
              </button>
            </li>
            <li class="page-item">
              <button
                type="button"
                class="page-link"
                v-for="pageNumber in pages.slice(page - 1, page + 5)"
                :key="pageNumber"
                @click="page = pageNumber"
              >
                {{ pageNumber }}
              </button>
            </li>
            <li class="page-item">
              <button
                type="button"
                @click="page++"
                v-if="page < pages.length"
                class="page-link"
              >
                Siguiente
              </button>
            </li>
          </ul>
        </nav>
      </div>
    </div>
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
      addedMoney: 0,
      account: [],
      pages: [],
      visible: true,
    };
  },
  methods: {
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
        .then((response) => response.data)
        .finally((data) => console.log(data));
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

<style scoped>
.pagination {
  text-align: center;
}
.page-item {
  padding: 1 rem;
}
button {
  background-color: deepskyblue;
  color: white;
}
</style>
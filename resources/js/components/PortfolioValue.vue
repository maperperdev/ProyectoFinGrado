<template>
  <div>
    <!-- <button @click="showValueAccount">showValueAccount</button> -->
    <p>Esto es mi portfolio value</p>
    <button @click="getAccount">Ver portfolio</button>

    <div v-show="account.length > 0" class="w-full py-8 md:px-32">
      <div class="overflow-hidden border-b border-gray-200 rounded shadow">
        <table class="min-w-full bg-white">
          <thead class="text-white bg-gray-800">
            <tr>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
              >
                Asset Name
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
              >
                Asset Type
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
              >
                Purchase Price
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
              >
                Purchase Date
              </th>
              <th
                class="w-1/3 px-4 py-3 text-sm font-semibold text-left uppercase"
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
              v-for="(elem, index) in account"
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
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      idUser: "",
      account: [],
    };
  },
  methods: {
    getAccount() {
      axios
        .post("/getAccountValue", {
          id_user: this.idUser,
        })
        .then((promiseResponse) => (this.account = promiseResponse.data))
        .finally(() => console.log("cargado"));
    },
    getIdUser() {
      this.idUser = axios
        .get("/user/id")
        .then((promiseResponse) => (this.idUser = promiseResponse.data));
    },
  },
  created() {
    this.getIdUser();
    this.getAccount();
  },
};
</script>
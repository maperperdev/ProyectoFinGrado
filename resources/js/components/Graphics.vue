<template>
  <div>
    <p>La id del usuario es: {{ idUser }}</p>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      idUser: "",
    };
  },
  methods: {
    getIdUser() {
      this.idUser = axios
        .get("/user/id")
        // .then((promiseResponse) => (this.idUser = promiseResponse.data));
        .then((promiseResponse) => (this.idUser = promiseResponse.data));
    },
  },
  created() {
    this.getIdUser();
  },
};
</script>
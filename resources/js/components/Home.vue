<template>
  <div class="container">
    <table>
      <tr>
        <td>Nombre</td>
        <td><input v-model="name" type="text" :readonly="readonly" /></td>
      </tr>
      <tr>
        <td>Email</td>
        <td>
          <input v-model="email" type="email" :readonly="readonly" />
        </td>
      </tr>
      <tr>
        <td>Contraseña</td>
        <td>
          <input v-model="password" type="password" :readonly="readonly" />
        </td>
      </tr>
      <tr>
        <td>Repetir contraseña</td>
        <td>
          <input
            v-model="repeatedPassword"
            type="password"
            :readonly="readonly"
          />
        </td>
      </tr>
    </table>
    <button
      class="px-4 py-2 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded  hover:bg-blue-500 hover:text-white hover:border-transparent"
      @click="readonly = !readonly"
    >
      {{ readonly ? "Modificar" : "Cancelar" }}
    </button>
    <button
      class="px-4 py-2 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded  hover:bg-blue-500 hover:text-white hover:border-transparent"
      @click="update"
    >
      Aceptar
    </button>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      oldUser: {
        name: "",
        email: "",
        password: "",
      },
      name: "",
      email: "",
      password: "",
      repeatedPassword: "",
      readonly: true,
      changeButtonText: true,
    };
  },
  methods: {
    getDataUser() {
      axios.get("/user/data").then((response) => {
        this.name = response.data.name;
        this.email = response.data.email;
        this.password = response.data.password;
        this.oldUser = {
          name: response.data.name,
          email: response.data.email,
          password: response.data.password,
        };
      });
    },
    update() {
      if (this.readonly) {
        alert("Tienes que modificar algo");
        return;
      }
      let updatedParam = {
        name: null,
        email: null,
        password: null,
      };
      if (this.name != this.oldUser.name) {
        updatedParam.name = this.name;
      }
      if (this.email != this.oldUser.email) {
        updatedParam.email = this.email;
      }
      if (this.password != this.oldUser.password) {
        updatedParam.password = this.password;
      }
      axios
        .post("/user/update", updatedParam)
        .then(() => alert("Usuario cambiado"));
    },
  },
  mounted() {
    this.getDataUser();
  },
};
</script>
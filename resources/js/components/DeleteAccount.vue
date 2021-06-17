<template>
  <div>
    <h1 class="text-4xl mb-10 text-red-500">Borrar cuenta</h1>
    <button
      class="px-4 py-2 font-semibold text-center text-red-700 bg-transparent border border-red-500 rounded  hover:bg-red-500 hover:text-white hover:border-transparent"
     @click="open">Eliminar</button>
    <vue-modal-2
      name="modal-1"
      :headerOptions="{
        title: 'Eliminar cuenta',
      }"
      @on-close="close"
      :footerOptions="{
        btn1: 'Cancelar',
        btn2: 'Eliminar',
        btn2Style: {
          backgroundColor: 'red',
        },
        btn2OnClick: () => {
          this.deleteAccount();
        },
        btn1OnClick: () => {
          $vm2.close('modal-1');
        },
      }"
    >
      <div class="px-7">
        Esta a acción no tendrá vuelta atrás. ¿Eliminará su cuenta de todas
        formas?
      </div>
    </vue-modal-2>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  methods: {
    open() {
      this.$vm2.open("modal-1");
    },
    close() {
      this.$vm2.close("modal-1");
    },
    deleteAccount() {
      this.close();
      axios.post("/delete-account")
            .then(console.log("cuenta borrada"));
      
    },
  },
};
</script>
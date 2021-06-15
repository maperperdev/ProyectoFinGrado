<template>
  <div>
    <p>Esto es mi modal</p>
    <button @click="open">Eliminar</button>
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
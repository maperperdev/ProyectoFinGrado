<template>
  <div>
    <p>Esto es mi pagina de compra</p>
    <select v-model="selected">
      <option disabled value="">Seleccione un elemento</option>
      <option>Acciones</option>
      <option>Criptomonedas</option>
    </select>

    <list-of-assets
      v-if="selected != ''"
      :selected="selectedReactive"
    ></list-of-assets>
  </div>
</template>

<script>
import ListOfAssets from "./ListOfAssets.vue";
export default {
  data() {
    return {
      selected: "",
    };
  },
  computed: {
    selectedReactive() {
      return this.selected;
    },
  },
  components: {
    ListOfAssets,
  },
};
</script>
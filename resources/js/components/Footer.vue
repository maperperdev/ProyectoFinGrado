<template>
  <footer class="w-full pt-8 pb-6 bg-gray-300 sticky">
    <div class="container px-4 mx-auto">
      <div class="flex flex-wrap">
        <div class="w-full px-4 lg:w-6/12">
          <h4 class="text-3xl font-semibold">¡Pruebe nuestra aplicación!</h4>
          <h5 class="mt-0 mb-2 text-lg text-gray-700">
            Puede hacer sus inversiones con nuestros patrocinadores.
          </h5>
        </div>
        <div class="w-full px-4 lg:w-6/12">
          <div class="flex flex-wrap mb-6 items-top">
            <div class="w-full px-4 ml-auto lg:w-4/12">
              <span
                class="block mb-2 text-sm font-semibold text-gray-600 uppercase"
                >Enlaces Útiles</span
              >
              <ul class="list-unstyled">
                <li>
                  <a
                    class="block pb-2 text-sm font-semibold text-gray-700  hover:text-gray-900"
                    href="https://es.finance.yahoo.com/"
                    >Yahoo Finance</a
                  >
                </li>
                <li>
                  <a
                    class="block pb-2 text-sm font-semibold text-gray-700  hover:text-gray-900"
                    href="https://coinmarketcap.com/"
                    >CoinMarketCap</a
                  >
                </li>
                <li>
                  <a
                    class="block pb-2 text-sm font-semibold text-gray-700  hover:text-gray-900"
                    href="https://github.com/maperperdev/ProyectoFinGrado/"
                    >Github</a
                  >
                </li>
              </ul>
            </div>
            <div class="w-full px-4 lg:w-4/12">
              <span
                class="block mb-2 text-sm font-semibold text-gray-600 uppercase"
                >Patrocinadores</span
              >
              <ul class="list-unstyled">
                <li>
                  <a
                    class="block pb-2 text-sm font-semibold text-gray-700  hover:text-gray-900"
                    href="https://www.ft.com/"
                    >Financial Times</a
                  >
                </li>
                <li>
                  <a
                    class="block pb-2 text-sm font-semibold text-gray-700  hover:text-gray-900"
                    href="https://www.degiro.es/"
                    >DeGiro</a
                  >
                </li>
                <li>
                  <a
                    class="block pb-2 text-sm font-semibold text-gray-700  hover:text-gray-900"
                    href="https://www.binance.com/"
                    >Binance</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-6 border-gray-400" />
      <div
        class="flex flex-wrap items-center justify-center md:justify-between"
      >
        <div class="w-full px-4 mx-auto text-center md:w-4/12">
          <div class="py-1 text-sm font-semibold text-gray-600">
            Copyright © {{ date }} Portfolio digital by
            <a
              href="https://github.com/maperperdev"
              class="text-gray-600 hover:text-gray-900"
              >maperperdev</a
            >.
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
<style scoped>
footer {
  position: fixed;
  bottom: 0;
  left: 0;
}
</style>
<script>
export default {
  data() {
    return {
      date: new Date().getFullYear(),
    };
  },
};
</script>
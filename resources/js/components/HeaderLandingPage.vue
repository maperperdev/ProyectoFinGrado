<template>
  <header class="text-gray-600 body-font">
    <div
      class="container flex flex-col flex-wrap items-center p-5 mx-auto md:flex-row"
    >
      <a
        class="flex items-center mb-4 font-medium text-gray-900 title-font md:mb-0"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          class="w-10 h-10 p-2 text-white bg-indigo-500 rounded-full"
          viewBox="0 0 24 24"
        >
          <path
            d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"
          ></path>
        </svg>
        <span class="ml-3 text-xl">Portfolio digital</span>
      </a>
      <nav
        class="flex flex-wrap items-center justify-center text-base md:ml-auto"
      >
        <slot></slot>
      </nav>
    </div>
  </header>
</template>


<script>
export default {
  name: "header-landing-component",
  data() {
    return {};
  },
};
</script>


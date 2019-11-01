<template>
  <ul>
    <li v-for="indicator in indicators" :key="indicator.id">
    <indicator :indicator="indicator"></indicator>
  </li>
  </ul>
</template>

<script>
import Indicator from './Indicator.vue'
export default {
  props: ["indicators"],
  components: {Indicator},
};
</script>

<template>
  <div class="">
    <p>{{competence.name}}</p>
    <span class="has-text-weight-semibold">Indicador (es):</span>
    <indicators v-if="competence.indicators.length" :indicators="competence.indicators"></indicators>

    <p class="is-size-7" v-else>
      <small>Aún no se ha(n) asignado indicador(es) a esta competencia.</small>
    </p>
    <a href="#" @click.prevent="$emit('indicator', competence)">agregar indicador</a>
  </div>
</template>

<script>
import Indicators from "../indicators/Indicators.vue";
export default {
  props: ["competence"],
  components: { Indicators }
};
</script>

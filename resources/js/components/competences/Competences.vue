<template>
  <ul>
    <li v-for="competence in competences" :key="competence.id">
    <competence :competence="competence" @indicator="passToIndicatorForm"></competence>
  </li>
  </ul>
</template>

<script>
import Competence from './Competence.vue'
export default {
  props: ["competences"],
  components: {Competence},
  methods: {
    passToIndicatorForm(competence) {
      //emitir
      CompetenceComponentEmitter.$emit('indicator', competence)
    }
  }
};
</script>

<template>
  <div>
    <p><span>{{competence.name}}</span> 
    <a href="#" @click.prevent="editCompetence(competence)"><i class="fa fa-edit has-text-primary is-size-5" ></i></a>
    <a href="#" @click.prevent="deleteCompetence(competence)"><i class="fa fa-trash has-text-danger is-size-5"></i></a>
    </p>
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
  components: { Indicators },
  methods: {
    /** Emit event to parent with the competence to edition */
    editCompetence(competence) {
      CompetenceComponentEmitter.$emit('edit', competence)
    },
    deleteCompetence(competence) {
      axios.delete(`/competences/${competence.id}`).then(response => {
        console.log(response.data.message)
        CompetenceComponentEmitter.$emit('deleted')
      })
    }
  }
};
</script>

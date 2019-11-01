<template>
  <div class="box">
    <div class="level">
     <div class="level-left">
       <div class="level-item">
        <h4 id="const" class="title is-3">{{component.name}}</h4>
       </div>
     </div>
      <div class="level-right">
        <div class="level-item">
            <a title="Editar" class="is-size-4" href="#"><i class="fa fa-edit has-text-primary"></i></a>
        </div>
      </div>
    </div>
    <section class="columns">
      <div class="column">
        <p class="is-size-6"><span class="has-text-weight-semibold">Área fundamental:</span> {{component.mandatory_area.name}}</p>
      </div>
      <div class="column">
         <div class="is-size-7">
         <span class="has-text-weight-semibold">Competencia (s):</span>
          <competences v-if="component.competences.length" :competences="component.competences"></competences>
          <div class="message is-warning is-size-7" v-else>
            <p class="message-body">Aún no se ha(n) asignado competencia(s) a este componente.</p>
          </div>
         </div>
      </div>
    </section>
    <p class="is-size-7">
      <span class="has-text-weight-semibold">Grados:</span>
      <span v-for="grade in component.grades" :key="grade.id">{{grade.name}}, </span>
    </p>

     <div class="level">
     <div class="level-left">
       <div class="level-item">
        <p class="is-size-7">Creado el: <em>{{component.created_at}}</em></p>
       </div>
     </div>
      <div class="level-right">
        <div class="level-item">
            <a class="is-size-6" href="#" @click.prevent="$emit('competence')">agregar competencia</a>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import Competences from '../competences/Competences.vue'
export default {
  props:['component'],
  components: {Competences},
  data() {
    return {};
  },
  created() {},
  methods: {}
};
</script>
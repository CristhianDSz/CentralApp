<template>
    <modal :modalActive="modalActive" :large="true" @close="modalActive=!modalActive">
        <template slot="title">Información de Objeto de Aprendizaje</template>
        <template slot="body">
            <div class="row" v-if="currentOva.image">
                <div class="image has-text-centered">
                    <figure class="image is-96x96">
                    <img class="is-rounded" :src="`/storage/${currentOva.image}`">
                </figure>
                </div>
            </div>
            <div class="level" style="margin-bottom:12px;">
                <div class="level-left">
                    <div class="level-item">
                        <h4 id="const" class="title is-3">Tema: {{currentOva.theme}}</h4>
                    </div>
                </div>
                <div class="level-right">
                   <div class="level-item">
                        <div class="tags has-addons">
                         <span class="tag">Grado</span>
                         <span class="tag is-primary">{{currentOva.grade.name}}</span>
                    </div>
                   </div>
                   <div class="level-item">
                    <div class="tags has-addons">
                        <span class="tag">Clase</span>
                        <span class="tag is-info">{{currentOva.class.name}}</span>
                    </div>
                   </div>
                </div>
            </div>
           <div class="row">
                <div class="columns">
                <div class="column">
                    <p class="is-size-7"><span class="has-text-weight-semibold">Fecha de creación:</span>
                        {{currentOva.created_at}}
                    </p>
                    <p class="is-size-7"><span class="has-text-weight-semibold">Autor:</span>
                        {{currentOva.user.name}}
                    </p>
                </div>
                <div class="column">
                    <p class="has-text-left is-size-6">
                        <span class="has-text-weight-semibold">Área:</span>
                        {{currentOva.mandatory_area.name}}
                    </p>
                   
                </div>
                <div class="column has-text-centered">
                     <p></p>
                     <p class="is-size-7">
                        <span class="has-text-weight-semibold">Asignatura:</span>
                        {{currentOva.subject.name}}
                    </p>
                </div>
                </div>
           </div>
           <hr>
           <div class="row" v-if="currentOva.learning_sections.length">
               <h6 class="is-size-6 has-text-centered">Unidades de aprendizaje</h6>
               <table class="table is-size-7">
                   <thead>
                       <th>Unid.</th>
                       <th>Título</th>
                       <th class="has-text-centered">Contexto</th>
                       <th class="has-text-centered">Componentes</th>
                       <th class="has-text-centered">Competencias</th>
                       <th class="has-text-right">Indicadores</th>
                   </thead>
                   <tbody>
                       <tr v-for="(learningSection, index) in currentOva.learning_sections" :key="learningSection.title">
                           <td>{{index+ 1}}</td>
                           <td>{{learningSection.title}}</td>
                           <td class="has-text-centered">{{learningSection.context}}</td>
                           <td class="has-text-centered">
                               <p v-for="component in learningSection.components" :key="component.id">{{component.name}}</p>
                           </td>
                           <td class="has-text-centered">
                                <p v-for="competence in learningSection.competences" :key="competence.id">{{competence.name}}</p>
                           </td>
                           <td class="has-text-right">
                                <p v-for="indicator in learningSection.indicators" :key="indicator.id">{{indicator.name}}</p>
                           </td>
                       </tr>
                   </tbody>
               </table>
               <table class="table is-size-7">
                   <thead>
                       <th>Unid.</th>
                       <th>Recursos</th>
                       <th class="has-text-centered">Referencias bibliográficas</th>
                       <th class="has-text-right">Actividades</th>
                   </thead>
                   <tbody>
                       <tr v-for="(learningSection,index) in currentOva.learning_sections" :key="learningSection.title">
                           <td>{{index +1}}</td>
                           <td>
                               <template v-if="learningSection.resources.length">
                                    <p v-for="resource in learningSection.resources" :key="resource.id">{{resource.url}}</p>
                               </template>
                               <span v-else>Ninguno</span>
                           </td>
                           <td class="has-text-centered">
                              <template v-if="learningSection.bibliographies.length">
                                   <p v-for="bibliography in learningSection.bibliographies" :key="bibliography.id">{{bibliography.url}}</p>
                              </template>
                               <span v-else>Ninguna</span>
                           </td>
                           <td class="has-text-right">
                               <template v-if="learningSection.homeworks.length">
                                    <div v-for="homework in learningSection.homeworks" :key="homework.id">
                                    <p><span class="has-text-weight-semibold">Contenido:</span> {{homework.content}}</p>
                                    <p><span class="has-text-weight-semibold">Entregable:</span> {{homework.presentation}}</p>
                                </div>
                               </template>
                               <span v-else>Ninguna</span>
                           </td>
                       </tr>
                   </tbody>
               </table>
           </div>
        </template>
    </modal>
</template>

<script>
import Modal from "../utils/Modal.vue";
export default {
  components: { Modal },
  data() {
    return {
        modalActive: false,
        currentOva: ''
    };
  },
  created() {
      /** Listening when a detail needs to be showed  */
      OvaEmitter.$on('detail', (ova) => {
          this.modalActive = !this.modalActive
          this.currentOva = ova
      })
  }
};
</script>
<style scoped>
    .image {
        display: flex;
        justify-content: center;
    }
</style>
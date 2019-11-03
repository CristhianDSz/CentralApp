<template>
      <div class="is-size-7">
        <p>
          <span class="has-text-weight-semibold">{{learningSection.title}}</span>
          <a href="#" @click.prevent="editLearningSection(learningSection)">
              <i class="fa fa-edit has-text-primary is-size-5"></i>
          </a>
          <a href="#" @click.prevent="deleteLearningSecion(learningSection)">
              <i class="fa fa-trash has-text-danger is-size-5"></i>
          </a>
        </p>
        <p>Contexto: {{learningSection.context}}</p>
        <div>
          <p>Componentes:</p>
          <ul>
            <li
              v-for="component in learningSection.components"
              :key="component.id"
            >{{component.name}}</li>
          </ul>
        </div>
        <br />
        <div>
          <p>Competencias:</p>
          <ul>
            <li
              v-for="competence in learningSection.competences"
              :key="competence.id"
            >{{competence.name}}</li>
          </ul>
        </div>
        <br />
        <div>
          <p>Indicadores:</p>
          <ul>
            <li
              v-for="indicator in learningSection.indicators"
              :key="indicator.id"
            >{{indicator.name}}</li>
          </ul>
        </div><br>
        <div>
          <p>Recursos:</p>
          <ul v-if="learningSection.resources.length">
            <li
              v-for="resource in learningSection.resources"
              :key="resource.id"
            >{{resource.url}}</li>
          </ul>
          <p class="is-small has-text-info" v-else>No existen recursos para esta unidad de aprendizaje</p>
        </div><br>
        <div>
          <p>Referencias bibliográficas:</p>
          <ul v-if="learningSection.bibliographies.length">
            <li
              v-for="bibliography in learningSection.bibliographies"
              :key="bibliography.id"
            >{{bibliography.url}}</li>
          </ul>
          <p class="is-small has-text-info" v-else>No existen referencias bibliográficas para esta unidad de aprendizaje</p>
        </div><br>
        <div>
          <p>Actividades:</p>
          <ul v-if="learningSection.homeworks.length">
            <li
              v-for="homework in learningSection.homeworks"
              :key="homework.id"
            >
            <p><span class="has-text-weight-semibold">Contenido</span>: {{homework.content}}</p>
            <p><span class="has-text-weight-semibold">Entregable</span>: {{homework.presentation}}</p>
            </li>
          </ul>
          <p class="is-small has-text-info" v-else>No existen actividades para esta unidad de aprendizaje</p>
        </div>
      </div>
</template>

<script>
export default {
  props:['learningSection'],
  methods: {
    editLearningSection(learningSection) {
      OvaLearningEmitter.$emit('edit-learning-section', learningSection)
    },
    deleteLearningSecion(learningSection) {
      axios.delete(`/learning-sections/${learningSection.id}`).then(response => {
        console.log(response.data.message)
        OvaLearningEmitter.$emit('learning-section-deleted')
      })
    }
  }
}
</script>

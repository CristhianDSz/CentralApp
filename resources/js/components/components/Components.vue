<template>
  <div>
    <my-component v-for="component in components" :key="component.id" :component="component" @competence="passToCompetenceForm(component)"></my-component>
    <modal
      :modalActive="competenceModal"
      @close="competenceModal=!competenceModal"
    >
      <template slot="title">Agregar competencia</template>
      <div class="content" slot="body">
        <h4>Qué es una competencia?</h4>
        <p class="is-size-6">
          Es un conjunto de conocimientos o habilidades que están apropiadamente relacionadas entre sí para facilitar el desempeño flexible, eficaz y con sentido, de una actividad.
        </p>
        <br />
        <competence-form 
          @success="showMessage" 
          @cancel="competenceModal=false"
          :component="currentComponent"
          >
        </competence-form>
      </div>
    </modal>
    <modal
      :modalActive="indicatorModal"
      @close="indicatorModal=!indicatorModal"
    >
      <template slot="title">Agregar indicador</template>
      <div class="content" slot="body">
        <competence-form 
          @success="showMessage" 
          @cancel="indicatorModal=false"
          >
        </competence-form>
      </div>
    </modal>
  </div>
</template>

<script>
import Modal from "../utils/Modal.vue";
import Component from "./Component.vue";
import CompetenceForm from '../competences/CompetenceForm.vue'

export default {
  components: { "my-component": Component, Modal, CompetenceForm },
  data() {
    return {
      components: [],
      competenceModal:false,
      indicatorModal:false,
      currentComponent:'',
      currentCompetence: '',
    };
  },
  created() {
    CompetenceComponentEmitter.$on('indicator', (competence) => {
      this.passToIndicatorForm(competence)
    })
    this.getComponents();
  },
  methods: {
    getComponents() {
      axios.get("/components").then(response => {
        this.components = response.data;
      });
    },
    showMessage() {
      this.competenceModal = false;
      this.getComponents();
    },
    passToCompetenceForm(component) {
      this.currentComponent = component
      this.competenceModal = true
    },
    passToIndicatorForm(competence) {
      this.currentCompetence = competence
      this.indicatorModal = true
    }
  }
};
</script>
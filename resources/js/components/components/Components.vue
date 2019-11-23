<template>
  <div>
    <template v-if="components.length">
      <my-component
      v-for="component in components"
      :key="component.id"
      :component="component"
      @competence="passToCompetenceForm(component)"
      @deleted="getComponents"
    ></my-component>
    </template>

    <div class="message is-warning is-size-7" v-else>
      <p class="message-body">Actualmente no existen componentes. Puede agregar uno dando clic en el botón de la parte superior</p>
    </div>

   

    <modal :modalActive="competenceModal" @close="competenceModal=!competenceModal">
      <template slot="title">Agregar competencia</template>
      <div class="content" slot="body">
        <h4>Qué es una competencia?</h4>
        <p
          class="is-size-6"
        >Es un conjunto de conocimientos o habilidades que están apropiadamente relacionadas entre sí para facilitar el desempeño flexible, eficaz y con sentido, de una actividad.</p>
        <br />
        <competence-form
          @success="showCompetenceMessage"
          @cancel="competenceModal=false"
          :component="currentComponent"
          ref="competenceForm"
        ></competence-form>
      </div>
    </modal>
    <modal :modalActive="indicatorModal" @close="indicatorModal=!indicatorModal">
      <template slot="title">Agregar indicador</template>
      <div class="content" slot="body">
        <indicator-form
          @success="showIndicatorMessage"
          @cancel="indicatorModal=false"
          :competence="currentCompetence"
          ref="indicatorForm"
        ></indicator-form>
      </div>
    </modal>

     <pagination ref="componentsPagination" @page="goToPage"></pagination>
  </div>
</template>

<script>
import Modal from "../utils/Modal.vue";
import Component from "./Component.vue";
import CompetenceForm from "../competences/CompetenceForm.vue";
import IndicatorForm from "../indicators/IndicatorForm.vue";
import Pagination from '../utils/Pagination.vue'

export default {
  components: {
    "my-component": Component,
    Modal,
    CompetenceForm,
    IndicatorForm,
    Pagination
  },
  data() {
    return {
      components: [],
      competenceModal: false,
      indicatorModal: false,
      currentComponent: "",
      currentCompetence: ""
    };
  },
  created() {
    /** Listening child for edit the incoming competence */
    CompetenceComponentEmitter.$on('edit', competence => {
      this.passToEditCompetenceForm(competence)
    })
    /** Listening child for deleted a competence */
    CompetenceComponentEmitter.$on('deleted', () => {
      this.getComponents()
    })
     /** Listening child for creating a indicator */
    CompetenceComponentEmitter.$on("indicator", competence => {
      this.passToIndicatorForm(competence);
    });
    /** Listening child for edit the incoming indicator */
    CompetenceComponentEmitter.$on('edit-indicator', indicator => {
      this.passToEditInidicatorForm(indicator)
    })
     /** Listening child for deleted an indicator */
    CompetenceComponentEmitter.$on('indicator-deleted', () => {
      this.getComponents()
    })
    this.getComponents();
  },
  methods: {
    goToPage(page) {
      this.getComponents(page)
    },
    getComponents(page = 1) {
      axios.get("/components?page=" + page).then(response => {
        this.$refs.componentsPagination.setPagination(response)
        this.components = response.data.data;
        this.$refs.componentsPagination.getPagesNumber()
      });
    },
    showCompetenceMessage() {
      this.competenceModal = false;
      this.getComponents();
    },
    showIndicatorMessage() {
      this.indicatorModal = false;
      this.getComponents();
    },
    /** Trigger method when child emit to creating a competence */
    passToCompetenceForm(component) {
      this.currentComponent = component;
      this.$refs.competenceForm.resetForm()
      this.competenceModal = true;
    },
    passToEditCompetenceForm(competence) {
      const {indicators, ...currentCompetence} = competence
      this.$refs.competenceForm.competence = currentCompetence
      this.competenceModal = true
    },
    passToIndicatorForm(competence) {
      this.currentCompetence = competence;
      this.$refs.indicatorForm.resetForm()
      this.indicatorModal = true;
    },
    passToEditInidicatorForm(indicator) {
      this.$refs.indicatorForm.indicator = {...indicator}
      this.indicatorModal = true
    }
  }
};
</script>
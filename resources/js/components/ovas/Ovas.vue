<template>
  <div>
    <template v-if="ovas.length">
      <ova v-for="ova in ovas" :key="ova.id" :ova="ova"   @learningSection="passToLearningSectionForm" 
      @deleted="getOvas">
      </ova>
    </template>


    <div class="message is-warning is-size-7" v-else>
      <p class="message-body">Actualmente no existen ovas. Puede agregar una dando clic en el botón de la parte superior</p>
    </div>

    <pagination ref="ovasPagination" @page="goToPage" v-show="ovas.length"></pagination>
    
    <modal
      :modalActive="learningSectionModal"
      :large="true"
      @close="learningSectionModal=!learningSectionModal"
    >
      <template slot="title">Agregar unidad de aprendizaje</template>
      <div class="content" slot="body">
        <h6>Unidad de aprendizaje</h6>
        <br />
        <learning-section-form 
          ref="learningForm" 
          @success="showLearningSectionMessage" 
          @cancel="learningSectionModal=false"
          :ova="currentOva"
          class="is-size-7"
          >
        </learning-section-form>
      </div>
    </modal>
    <ova-detail></ova-detail>
    <ova-image @success="getOvas"></ova-image>
  </div>
</template>

<script>
import Modal from "../utils/Modal.vue";
import Ova from "./Ova.vue";
import OvaDetail from './OvaDetail.vue'
import OvaImage from './OvaImage.vue'
import LearningSectionForm from '../learning-sections/LearningSectionForm.vue'
import Pagination from '../utils/Pagination.vue'

export default {
  components: { Ova, Modal, LearningSectionForm, OvaDetail, OvaImage, Pagination},
  data() {
    return {
      ovas: [],
      originalOvas: [],
      learningSectionModal:false,
      currentOva: '',
      currentLearningSection: '',
    };
  },
  created() {
    /** Listening to event when a learning section is going to be edited */
    OvaLearningEmitter.$on('edit-learning-section', learning => {
      /** Destructure properties from the incomming learning section */
      const {components, competences, indicators, ova, ...learningSection} = learning
      this.$refs.learningForm.learningSection = learningSection
      this.$refs.learningForm.selectedComponents = components
      this.$refs.learningForm.selectedCompetences = competences
      this.$refs.learningForm.selectedIndicators = indicators
      /** Set ova property */
      this.$refs.learningForm.ova = ova
      /** Call method for retrieve components */
      this.$refs.learningForm.getComponents()
      /** Call method for retrieve competences */
      this.$refs.learningForm.getCompetences(components)
      /** Call method for retrieve indicators */
      this.$refs.learningForm.getIndicators(competences)
      /** Assign extra properties in blank */
      this.$refs.learningForm.learningSection['components'] = []
      this.$refs.learningForm.learningSection['competences'] = []
      this.$refs.learningForm.learningSection['indicators'] = []
      /** Set learning section form child's properties */
      this.$refs.learningForm.$refs.resourceForm.resources = learningSection.resources
      this.$refs.learningForm.$refs.bibliographyForm.bibliographies = learningSection.bibliographies
      this.$refs.learningForm.$refs.homeworkForm.homeworks = learningSection.homeworks
      /** Show modal with form */
      this.learningSectionModal = true
    })
    /** Listening to event when a learning section is deleted */
    OvaLearningEmitter.$on('learning-section-deleted', () => {
      this.getOvas()
    })
    /** Get all existent ovas */
    this.getOvas();
  },
  methods: {
    goToPage(page) {
      this.getOvas(page)
    },
    getOvas(page = 1) {
      axios.get("/ovas?page=" + page).then(response => {
        this.$refs.ovasPagination.setPagination(response)
        this.ovas = response.data.data;
        this.originalOvas = response.data.data
        this.$refs.ovasPagination.getPagesNumber()
      });
    },
    showLearningSectionMessage() {
      this.learningSectionModal = false;
      this.getOvas();
    },
    passToLearningSectionForm(ova) {
      this.currentOva = ova
      this.learningSectionModal = true
    },
  }
};
</script>
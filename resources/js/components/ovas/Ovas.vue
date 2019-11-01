<template>
  <div>
    <ova v-for="ova in ovas" :key="ova.id" :ova="ova" @learningSection="passToLearningSectionForm"></ova>
    <modal
      :modalActive="learningSectionModal"
      :large="true"
      @close="learningSectionModal=!learningSectionModal"
    >
      <template slot="title">Agregar unidad de aprendizaje</template>
      <div class="content" slot="body">
        <h6>Unidad de aprendizaje</h6>
        <br />
        <learning-section-form v-if="learningSectionModal" 
          @success="showLearningSectionMessage" 
          @cancel="learningSectionModal=false"
          :ova="currentOva"
          class="is-size-7"
          >
        </learning-section-form>
      </div>
    </modal>
  </div>
</template>

<script>
import Modal from "../utils/Modal.vue";
import Ova from "./Ova.vue";
import LearningSectionForm from '../learning-sections/LearningSectionForm.vue'

export default {
  components: { Ova, Modal, LearningSectionForm},
  data() {
    return {
      ovas: [],
      learningSectionModal:false,
      currentOva: '',
      currentLearningSection: '',
    };
  },
  created() {
    // CompetenceComponentEmitter.$on('indicator', (competence) => {
    //   this.passToIndicatorForm(competence)
    // })
    this.getOvas();
  },
  methods: {
    getOvas() {
      axios.get("/ovas").then(response => {
        this.ovas = response.data;
      });
    },
    showLearningSectionMessage() {
      this.learningSectionModal = false;
      this.getOvas();
    },
    // showIndicatorMessage() {
    //   this.indicatorModal = false;
    //   this.getOvas();
    // },
    passToLearningSectionForm(ova) {
      this.currentOva = ova
      this.learningSectionModal = true
    },
    // passToIndicatorForm(competence) {
    //   this.currentCompetence = competence
    //   this.indicatorModal = true
    // }
  }
};
</script>
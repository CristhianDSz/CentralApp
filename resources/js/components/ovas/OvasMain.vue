<template>
  <div>
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <div class="field has-addons">
            <p class="control">
              <input class="input" type="text" v-model="ovaSearch" placeholder="Buscar ova" />
            </p>
          </div>
        </div>
      </div>
      <div class="level-right">
        <p class="level-item">
          <a class="button is-primary" @click="ovaModalActive=true">
            <span class="icon">
              <i class="fa fa-plus"></i>
            </span>
            <span>Crear Ova</span>
          </a>
        </p>
      </div>
      <modal
        :modalActive="ovaModalActive"
        @close="ovaModalActive=!ovaModalActive"
      >
        <template slot="title">Agregar Ova</template>
        <div class="content" slot="body">
          <h2>Qué es una Ova?</h2>
          <p>Las ovas para la educación están organizadas en componentes básicos interconectados. Esta forma de organización facilita una aproximación progresiva al conocimiento por parte de los estudiantes y orienta el trabajo de los docentes en el aula</p>
          <br />
          <ova-form ref="ovaForm" @success="showMessage" @cancel="ovaModalActive=false"></ova-form>
        </div>
      </modal>
    </div>
    <div class="columns">
      <div class="column">
        <div class="content is-medium">
          <ovas ref="ovas"></ovas>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Modal from "../utils/Modal.vue";
import OvaForm from "./OvaForm.vue";
import Ovas from "./Ovas.vue";
export default {
  components: { OvaForm, Ovas, Modal },
  data() {
    return {
      ovaModalActive: false,
      ovaSearch: ""
    };
  },
  created() {
    OvaEmitter.$on('edit', ova => {
      this.$refs.ovaForm.ova = ova
      this.$refs.ovaForm.selectedArea = ova.mandatory_area
      this.$refs.ovaForm.selectedClass = ova.class
      this.$refs.ovaForm.selectedGrade = ova.grade
      this.$refs.ovaForm.selectedSubject = ova.subject
      this.ovaModalActive = true
    })
  },
  methods: {
    showMessage() {
      this.ovaModalActive = false;
      this.$refs.ovas.getOvas();
    },
    
  },
  watch: {
    ovaSearch() {
      if (this.ovaSearch.length) {
        this.$refs.ovas.ovas = this.$refs.ovas.originalOvas.filter(
          ova => {
            return (
              ova.theme
                .toLowerCase()
                .indexOf(this.ovaSearch.toLowerCase()) > -1 ||
              ova.mandatory_area.name
                .toLowerCase()
                .indexOf(this.ovaSearch.toLowerCase()) > -1  
            );
          }
        );
      } else {
        this.$refs.ovas.ovas = this.$refs.ovas.originalOvas;
      }
    }
  }
};
</script>
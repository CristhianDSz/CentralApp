<template>
  <div>
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <div class="field has-addons">
            <p class="control">
              <input class="input" type="text" v-model="componentSearch" placeholder="Buscar componente" />
            </p>
          </div>
        </div>
      </div>
      <div class="level-right">
        <p class="level-item">
          <a class="button is-primary" @click="showModal">
            <span class="icon">
              <i class="fa fa-plus"></i>
            </span>
            <span>Crear componente</span>
          </a>
        </p>
      </div>
      <modal
        :modalActive="componentModalActive"
        @close="componentModalActive=!componentModalActive"
      >
        <template slot="title">Agregar componente</template>
        <div class="content" slot="body">
          <h2>Qué es un componente?</h2>
          <p>Las competencias para la educación están organizadas en componentes básicos interconectados. Esta forma de organización facilita una aproximación progresiva al conocimiento por parte de los estudiantes y orienta el trabajo de los docentes en el aula</p>
          <br />
          <component-form ref="componentForm" @success="showMessage" @cancel="componentModalActive=false"></component-form>
        </div>
      </modal>
    </div>
    <div class="columns">
      <div class="column">
        <div class="content is-medium">
          <components ref="components"></components>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Modal from "../utils/Modal.vue";
import ComponentForm from "./ComponentForm.vue";
import Components from "./Components.vue";
import {Toast} from '../../mixins/ToastMixin'
export default {
  components: { ComponentForm, Components, Modal },
  data() {
    return {
      componentModalActive: false,
      componentSearch: ""
    };
  },
  created() {
    /** Listening for edit event from component child  */
    ComponentEmitter.$on('edit', (component) => {
      this.$refs.componentForm.component = component
      this.$refs.componentForm.selectedArea = component.mandatory_area
      this.$refs.componentForm.selectedGrade = component.grades
      this.componentModalActive = true
    })
  },
  methods: {
    showMessage(message) {
      this.componentModalActive = false;
      this.modalActive = false
      Toast(this.$swal).fire({
        icon: 'success',
        title: message
      })

      this.$refs.components.getComponents();
    },
    showModal() {
      this.$refs.componentForm.resetForm()
      this.componentModalActive = true
    }
    
  },
  
  watch: {
    componentSearch() {
      if (this.componentSearch.length) {
        this.$refs.components.components = this.$refs.components.originalComponents.filter(
          component => {
            return (
              component.name
                .toLowerCase()
                .indexOf(this.componentSearch.toLowerCase()) > -1 ||
              component.mandatory_area.name
                .toLowerCase()
                .indexOf(this.componentSearch.toLowerCase()) > -1  
            );
          }
        );
      } else {
        this.$refs.components.components = this.$refs.components.originalComponents;
      }
    }
  }
};
</script>
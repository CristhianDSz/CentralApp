<template>
  <div>
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <div class="field has-addons">
            <p class="control">
              <input class="input" type="text" placeholder="Buscar componente" />
            </p>
            <p class="control">
              <button class="button">Buscar</button>
            </p>
          </div>
        </div>
      </div>
      <div class="level-right">
        <p class="level-item">
          <a class="button is-primary" @click="componentModalActive=true">
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
          <component-form @success="showMessage" @cancel="componentModalActive=false"></component-form>
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
export default {
  components: { ComponentForm, Components, Modal },
  data() {
    return {
      componentModalActive: false,
    };
  },
  methods: {
    showMessage() {
      this.componentModalActive = false;
      this.$refs.components.getComponents();
    },
    
  }
};
</script>
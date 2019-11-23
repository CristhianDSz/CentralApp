<template>
  <div class="card">
    <div class="card-filter">
      <div class="field">
        <div class="control has-icons-left has-icons-right">
          <input class="input" id="table-search" type="text" placeholder="Buscar clases" />
          <span class="icon is-left">
            <i class="fa fa-search"></i>
          </span>
        </div>
      </div>
      <div class="field has-addons">
        <p class="control">
          <a class="button" href="#" @click.prevent="modalActive = !modalActive">
            <span class="icon is-small">
              <i class="fa fa-plus"></i>
            </span>
            <span>Crear nueva</span>
          </a>
        </p>
      </div>
    </div>
    <div class="card-content">
      <div id="datatable_wrapper" class="dataTables_wrapper dt-bulma no-footer">
        <div class="columns table-wrapper">
           <classes ref="classes"></classes>
        </div>
      </div>
    </div>
    <div class="modal" :class="{'is-active': modalActive}">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title has-text-weight-bold">Crear Nueva Clase</p>
          <button class="delete" aria-label="close" @click="modalActive=false"></button>
        </header>
        <section class="modal-card-body">
          <class-form @success="showMessage"></class-form>
        </section>
        <footer class="modal-card-foot">
          <button class="button" @click="modalActive=false">Cancelar</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
import Classes from "./Classes.vue";
import ClassForm from './ClassForm.vue'
export default {
  components: { Classes, ClassForm },
  data() {
    return {
      modalActive: false
    }
  },
  methods: {
    showMessage() {
      this.modalActive = false
      this.$refs.classes.getClasses()
      //Mostrar modal sweetalert
    }
  }
};
</script>

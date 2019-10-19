<template>
  <div class="card">
    <div class="card-filter">
      <div class="field">
        <div class="control has-icons-left has-icons-right">
          <input class="input" id="table-search" type="text" placeholder="Buscar asignaturas" />
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
          <div class="column is-12">
            <table
              class="table is-hoverable is-bordered is-fullwidth dataTable no-footer"
              id="datatable"
              role="grid"
              aria-describedby="datatable_info"
            >
              <thead>
                <tr role="row">
                  <th style="width: 105.2px;">No</th>
                  <th style="width: 529.2px;">Name</th>
                  <th style="width: 529.2px;">Área</th>
                  <th style="width: 198.2px;">Action</th>
                </tr>
              </thead>
              <subjects ref="subjects"></subjects>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" :class="{'is-active': modalActive}">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title has-text-weight-bold">Crear Nueva Asignatura</p>
          <button class="delete" aria-label="close" @click="modalActive=false"></button>
        </header>
        <section class="modal-card-body">
          <subject-form @success="showMessage"></subject-form>
        </section>
        <footer class="modal-card-foot">
          <button class="button" @click="modalActive=false">Cancelar</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
import Subjects from "./Subjects.vue";
import SubjectForm from './SubjectForm.vue'
export default {
  components: { Subjects, SubjectForm },
  data() {
    return {
      modalActive: false
    }
  },
  methods: {
    showMessage() {
      this.modalActive = false
      this.$refs.subjects.getSubjects()
      //Mostrar modal sweetalert
    }
  }
};
</script>

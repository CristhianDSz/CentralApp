<template>
  <div class="card">
    <div class="card-filter">
      <div class="field">
        <div class="control has-icons-left has-icons-right">
          <input class="input" id="table-search" type="text" v-model="gradeSearch" placeholder="Buscar grados" />
          <span class="icon is-left">
            <i class="fa fa-search"></i>
          </span>
        </div>
      </div>
      <div class="field has-addons">
        <p class="control" >
          <a class="button" href="#" @click.prevent="modalActive = !modalActive">
            <span class="icon is-small">
              <i class="fa fa-plus"></i>
            </span>
            <span>Crear nuevo</span>
          </a>
        </p>
      </div>
    </div>
    <div class="card-content">
      <div id="datatable_wrapper" class="dataTables_wrapper dt-bulma no-footer">
        <div class="columns table-wrapper">
          <grades ref="grades"></grades>
        </div>
      </div>
    </div>
    <div class="modal" :class="{'is-active': modalActive}">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title has-text-weight-bold">Crear Nuevo Grado</p>
          <button class="delete" aria-label="close" @click="modalActive=false"></button>
        </header>
        <section class="modal-card-body">
          <grade-form @success="showMessage"></grade-form>
        </section>
        <footer class="modal-card-foot">
          <button class="button" @click="modalActive=false">Cancelar</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
import Grades from "./Grades.vue";
import GradeForm from './GradeForm.vue'
export default {
  components: { Grades, GradeForm },
  data() {
    return {
      modalActive: false,
      enableCreateButton:true,
      gradeSearch: ""
    }
  },
  methods: {
    showMessage() {
      this.modalActive = false
      this.$refs.grades.getGrades()
      //Mostrar modal sweetalert
    }
  },
  watch:{
    gradeSearch() {
      if (this.gradeSearch.length) {
        this.$refs.grades.grades = this.$refs.grades.originalGrades.filter(grade => {
          return grade.name.toLowerCase().indexOf(this.gradeSearch.toLowerCase()) > -1
        })
      } else {
        this.$refs.grades.grades = this.$refs.grades.originalGrades
      }
    }
  }
};
</script>

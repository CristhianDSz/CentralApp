<template>
  <div class="card">
    <div class="card-filter">
      <div class="field">
        <div class="control has-icons-left has-icons-right">
          <input class="input" id="table-search" v-model="subjectSearch" type="text" placeholder="Buscar asignaturas" />
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
          <subjects ref="subjects"></subjects>
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
import SubjectForm from "./SubjectForm.vue";
import {Toast} from '../../mixins/ToastMixin'
export default {
  components: { Subjects, SubjectForm },
  data() {
    return {
      modalActive: false,
      subjectSearch: ""
    };
  },
  methods: {
    showMessage(message) {
      this.modalActive = false;
      Toast(this.$swal).fire({
        icon: 'success',
        title: message
      })

      this.$refs.subjects.getSubjects();
      //Mostrar modal sweetalert
    }
  },
  watch: {
    subjectSearch() {
      if (this.subjectSearch.length) {
        this.$refs.subjects.subjects = this.$refs.subjects.originalSubjects.filter(
          subject => {
            return (
              subject.name
                .toLowerCase()
                .indexOf(this.subjectSearch.toLowerCase()) > -1 ||
              subject.mandatory_area.name
                .toLowerCase()
                .indexOf(this.subjectSearch.toLowerCase()) > -1  
            );
          }
        );
      } else {
        this.$refs.subjects.subjects = this.$refs.subjects.originalSubjects;
      }
    }
  }
};
</script>

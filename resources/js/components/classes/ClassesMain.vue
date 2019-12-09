<template>
  <div class="card">
    <div class="card-filter">
      <div class="field">
        <div class="control has-icons-left has-icons-right">
          <input class="input" id="table-search" type="text" v-model="classSearch" placeholder="Buscar clases" />
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
import {Toast} from '../../mixins/ToastMixin'
export default {
  components: { Classes, ClassForm },
  data() {
    return {
      modalActive: false,
      classSearch: ""
    }
  },
  methods: {
    showMessage(message) {
      this.modalActive = false
      Toast(this.$swal).fire({
        icon: 'success',
        title: message
      })
      this.$refs.classes.getClasses()
    }
  },
  watch: {
    classSearch() {
      if (this.classSearch.length) {
        this.$refs.classes.classes = this.$refs.classes.originalClasses.filter(
          schoolClass => {
            return (
              schoolClass.name
                .toLowerCase()
                .indexOf(this.classSearch.toLowerCase()) > -1 ||
              schoolClass.grade.name
                .toLowerCase()
                .indexOf(this.classSearch.toLowerCase()) > -1  
            );
          }
        );
      } else {
        this.$refs.classes.classes = this.$refs.classes.originalClasses;
      }
    }
  }
};
</script>

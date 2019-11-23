<template>
  <div class="card">
    <div class="card-filter">
      <div class="field">
        <div class="control has-icons-left has-icons-right">
          <input class="input" id="table-search" type="text" v-model="presentationSearch" placeholder="Buscar entregables" />
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
          <presentations ref="presentations"></presentations>
        </div>
      </div>
    </div>
    <div class="modal" :class="{'is-active': modalActive}">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title has-text-weight-bold">Crear Nuevo Entregable</p>
          <button class="delete" aria-label="close" @click="modalActive=false"></button>
        </header>
        <section class="modal-card-body">
          <presentation-form @success="showMessage"></presentation-form>
        </section>
        <footer class="modal-card-foot">
          <button class="button" @click="modalActive=false">Cancelar</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
import Presentations from "./Presentations.vue";
import PresentationForm from './PresentationForm.vue'
export default {
  components: { Presentations, PresentationForm },
  data() {
    return {
      modalActive: false,
      enableCreateButton:true,
      presentationSearch: ""
    }
  },
  methods: {
    showMessage() {
      this.modalActive = false
      this.$refs.presentations.getPresentations()
      //Mostrar modal sweetalert
    }
  },
  watch:{
    presentationSearch() {
      if (this.presentationSearch.length) {
        this.$refs.presentations.presentations = this.$refs.presentations.originalPresentations.filter(presentation => {
          return presentation.name.toLowerCase().indexOf(this.presentationSearch.toLowerCase()) > -1
        })
      } else {
        this.$refs.presentations.presentations = this.$refs.presentations.originalPresentations
      }
    }
  }
};
</script>

<template>
  <div class="card">
    <div class="card-filter">
      <div class="field">
        <div class="control has-icons-left has-icons-right">
          <input class="input" id="table-search" type="text" v-model="areaSearch" placeholder="Buscar áreas" />
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
          <areas ref="areas"></areas>
        </div>
      </div>
    </div>
    <div class="modal" :class="{'is-active': modalActive}">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title has-text-weight-bold">Crear Nueva Área</p>
          <button class="delete" aria-label="close" @click="modalActive=false"></button>
        </header>
        <section class="modal-card-body">
          <area-form @success="showMessage"></area-form>
        </section>
        <footer class="modal-card-foot">
          <button class="button" @click="modalActive=false">Cancelar</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
import Areas from "./Areas.vue";
import AreaForm from './AreaForm.vue'
import {Toast} from '../../mixins/ToastMixin'
export default {
  components: { Areas, AreaForm },
  data() {
    return {
      modalActive: false,
      areaSearch: ''
    }
  },
  methods: {
    showMessage(message) {
      this.modalActive = false
      Toast(this.$swal).fire({
        icon: 'success',
        title: message
      })

      this.$refs.areas.getAreas()
    }
  },
  watch:{
    areaSearch() {
      if (this.areaSearch.length) {
        this.$refs.areas.areas = this.$refs.areas.originalAreas.filter(area => {
          return area.name.toLowerCase().indexOf(this.areaSearch.toLowerCase()) > -1
        })
      } else {
        this.$refs.areas.areaas = this.$refs.areas.originalAreas
      }
    }
  }
};
</script>

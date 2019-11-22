<template>
  <div class="box">
    <div class="level" style="margin-bottom:12px;">
      <div class="level-left">
        <div class="level-item">
          <h4 id="const" class="title is-3">Ova: {{ova.theme}}</h4>
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          <a title="Generar PDF" class="is-size-4" target="_blank" :href="`/app/ovas/pdf/${ova.id}`">
            <i class="fa fa-file-pdf-o has-text-danger"></i>
          </a>
        </div>
        <div class="level-item">
          <a title="Detalles" class="is-size-4" href="#" @click.prevent="detailOva(ova)">
            <i class="fa fa-eye has-text-primary"></i>
          </a>
        </div>
        <div class="level-item">
          <a title="Imagen" class="is-size-4" href="#" @click.prevent="addOrUpdateImage(ova)">
            <i class="fa fa-image has-text-primary"></i>
          </a>
        </div>
        <div class="level-item" v-if="$can('update ovas')">
          <a title="Editar" class="is-size-4" href="#" @click.prevent="editOva(ova)">
            <i class="fa fa-edit has-text-primary"></i>
          </a>
        </div>
        <div class="level-item" v-if="$can('delete ovas')">
          <a title="Eliminar" class="is-size-4" href="#" @click.prevent="deleteOva(ova)">
            <i class="fa fa-trash has-text-danger"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <p class="is-size-6">
          <span class="has-text-weight-semibold">Área fundamental:</span>
          {{ova.mandatory_area.name}}
        </p>
      </div>
      <div class="column">
        <p class="is-size-6">
          <span class="has-text-weight-semibold">Asignatura:</span>
          {{ova.subject.name}}
        </p>
      </div>
      <div class="column">
        <div class="columns">
          <div class="column">
            <div class="tags has-addons">
              <span class="tag">Grado</span>
              <span class="tag is-primary">{{ova.grade.name}}</span>
            </div>
          </div>
          <div class="column">
            <div class="tags has-addons">
              <span class="tag">Clase</span>
              <span class="tag is-info">{{ova.class.name}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <h6 class="has-text-weight-semibold has-text-centered is-size-6">Unidad(es) de aprendizaje:</h6>
    <learning-sections v-if="ova.learning_sections.length" :learningSections="ova.learning_sections"></learning-sections>
    <div class="message is-warning has-text-centered" v-else>
      <p class="message-body">Actualmente no existen unidades de aprendizaje para esta OVA</p>
    </div>
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <p class="is-size-7">
            Creado el:
            <em>{{ova.created_at}}</em> por
            <em>{{ova.user.name}}</em>
          </p>
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          <a class="is-size-6 has-text-primary" href="#" @click.prevent="$emit('learningSection',ova)">
            <i class="fa fa-plus-circle is-size-5"></i> Unidad de aprendizaje
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {permissionsMixin} from '../../mixins/PermissionsMixin'
import learningSections from '../learning-sections/LearningSections'
export default {
  props: ["ova"],
  mixins:[permissionsMixin],
  components: {learningSections},
  data() {
    return {};
  },
  created() {},
  methods: {
    editOva(ova) {
      OvaEmitter.$emit('edit', ova)
    },
    deleteOva(ova) {
      axios.delete(`/ovas/${ova.id}`).then(response => {
        console.log(response.data.message)
        this.$emit('deleted')
      })
    },
    detailOva(ova) {
      OvaEmitter.$emit('detail',ova)
    },
    addOrUpdateImage(ova) {
      OvaEmitter.$emit('image',ova)
    }
  }
};
</script>
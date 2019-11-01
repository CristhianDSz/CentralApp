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
          <a title="Generar PDF" class="is-size-4" href="#">
            <i class="fa fa-file-pdf-o has-text-danger"></i>
          </a>
        </div>
        <div class="level-item">
          <a title="Editar" class="is-size-4" href="#">
            <i class="fa fa-edit has-text-primary"></i>
          </a>
        </div>
        <div class="level-item">
          <a title="Eliminar" class="is-size-4" href="#">
            <i class="fa fa-trash has-text-danger"></i>
          </a>
        </div>
      </div>
    </div>
    <p class="is-size-7">
            Creado el:
            <em>{{ova.created_at}}</em> por
            <em>{{ova.user.name}}</em>
          </p>
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
    <div class="columns" v-if="ova.learning_sections.length">
      <div class="column" v-for="learningSection in ova.learning_sections" :key="learningSection.id">
        <div class="is-size-7">
              <p class="has-text-weight-semibold">{{learningSection.title}}</p>
                <p>Contexto: {{learningSection.context}}</p>
                <div>
                  <p>Componentes:</p>
                  <ul>
                    <li
                      v-for="component in learningSection.components"
                      :key="component.id"
                    >{{component.name}}</li>
                  </ul>
                </div>
                <br />
                <div>
                  <p>Competencias:</p>
                  <ul>
                    <li
                      v-for="competence in learningSection.competences"
                      :key="competence.id"
                    >{{competence.name}}</li>
                  </ul>
                </div>
                <br />
                <div>
                  <p>Indicadores:</p>
                  <ul>
                    <li
                      v-for="indicator in learningSection.indicators"
                      :key="indicator.id"
                    >{{indicator.name}}</li>
                  </ul>
                </div>
          <!-- <competences v-if="component.competences.length" :competences="component.competences"></competences>
          <div class="message is-warning is-size-7" v-else>
            <p class="message-body">Aún no se ha(n) asignado competencia(s) a este componente.</p>
          </div>-->
        </div>
      </div>
    </div>
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
          <a class="is-size-6" href="#" @click.prevent="$emit('learningSection',ova)">
            <i class="fa fa-plus"></i> Unidad de aprendizaje
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
//import Competences from '../competences/Competences.vue'
export default {
  props: ["ova"],
  //components: {Competences},
  data() {
    return {};
  },
  created() {},
  methods: {}
};
</script>
<template>
  <form @submit.prevent="makeRequest">
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Título</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input class="input" v-model="learningSection.title" type="text" placeholder="Título" />
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Fechas Inicio/Final</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input class="input" v-model="learningSection.start_date" type="date" />
          </div>
        </div>
        <div class="field">
          <div class="control">
            <input class="input" v-model="learningSection.end_date" type="date" />
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Contexto</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <textarea class="textarea" v-model="learningSection.context" placeholder="Contexto..."></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Componentes</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <multiselect
              v-model="selectedComponents"
              track-by="name"
              :options="components"
              :multiple="true"
              :close-on-select="false"
              :clear-on-select="false"
              :disabled="enableComponents"
              @input="getCompetences(selectedComponents)"
              class="is-fullwidth"
              label="name"
              placeholder="Seleccione componente"
            >
              <template slot="selection" slot-scope="{ values, search, isOpen }">
                <span
                  class="multiselect__single"
                  v-if="values.length &amp;&amp; !isOpen"
                >{{ values.length }} componentes seleccionados</span>
              </template>
            </multiselect>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Competencias</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <multiselect
              v-model="selectedCompetences"
              track-by="name"
              :options="competences"
              :multiple="true"
              :close-on-select="false"
              :clear-on-select="false"
              @input="getIndicators(selectedCompetences)"
              :disabled="enableCompetences"
              label="name"
              class="is-fullwidth"
              placeholder="Seleccione competencia"
            >
              <template slot="selection" slot-scope="{ values, search, isOpen }">
                <span
                  class="multiselect__single"
                  v-if="values.length &amp;&amp; !isOpen"
                >{{ values.length }} competencias seleccionadas</span>
              </template>
            </multiselect>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Indicadores</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <multiselect
              v-model="selectedIndicators"
              track-by="name"
              :options="indicators"
              :multiple="true"
              :close-on-select="false"
              :clear-on-select="false"
              :disabled="enableIndicators"
              label="name"
              placeholder="Seleccione indicador"
              class="is-fullwidth"
            >
              <template slot="selection" slot-scope="{ values, search, isOpen }">
                <span
                  class="multiselect__single"
                  v-if="values.length &amp;&amp; !isOpen"
                >{{ values.length }} indicadores seleccionados</span>
              </template>
            </multiselect>
          </div>
        </div>
      </div>
    </div>

    <resource-form ref="resourceForm" @resources="learningSection.resources=$event"></resource-form><br>

    <bibliography-form ref="bibliographyForm" @bibliographies="learningSection.bibliographies = $event">
    </bibliography-form><br>

    <homework-form ref="homeworkForm" @homeworks="learningSection.homeworks=$event"></homework-form>
   
    <div class="control has-text-right">
      <button type="submit" class="button is-primary" :disabled="formActionable">Agregar</button>
      <button type="button" class="button is-danger" @click="$emit('cancel')">Cancelar</button>
    </div>
  </form>
</template>

<script>
import ResourceForm from '../resources/ResourceForm.vue'
import HomeworkForm from '../homeworks/HomeworkForm.vue'
import BibliographyForm from '../bibliographies/BibliographyForm.vue'
export default {
  props: ['ova'],
  components: {ResourceForm,BibliographyForm,HomeworkForm},
  data() {
    return {
      components: [],
      competences: [],
      indicators: [],
      selectedComponents: [],
      selectedCompetences: [],
      selectedIndicators: [],
      learningSection: {
        id: "",
        theme: "",
        context: "",
        start_date: "",
        end_date: "",
        ova_id: "",
        components: [],
        competences: [],
        indicators: [],
        resources:[],
        bibliographies:[],
        homeworks:[]
      },
    };
  },
  created() {
    this.getComponents();
    this.setInitialDates()
  },
  methods: {
    getComponents() {
      if (this.ova) {
        axios.get(`/ovas/${this.ova.id}/components`).then(response => {
          this.components = response.data
        })
      }
    },
    getCompetences(components = []) {
      // If we have competences, we reasign the property to an empty array
      if (this.competences.length) this.competences = []
      // Fill the array again with the new values
      components.forEach(component => {
        this.competences.push(...component.competences);
      });
    },
    getIndicators(competences = []) {
      // If we have indicator, we reasign the property to  an empty array
      if (this.indicators.length) this.indicators = []
      // Fill the array again with the new values
      competences.forEach(competence => {
        this.indicators.push(...competence.indicators);
      });
    },
    makeRequest() {
      if (this.learningSection.id) {
        this.putLearningSection()
      } else {
        this.postLearningSection()
      }
    },
    postLearningSection() {
      //Set learning section's foreign keys before we make request
      this.learningSection.ova_id = this.ova.id;
      this.assignBeforeSend()
      axios.post("/learning-sections", this.learningSection).then(response => {
        console.log(response.data.message);
        this.resetForm();
        this.$emit("success", response.data.message);
      });
    },
    putLearningSection() {
      this.assignBeforeSend()
      axios.put(`/learning-sections/${this.learningSection.id}`,
        this.learningSection).then(response => {
          console.log(response.data.message)
          this.resetForm()
          this.$emit('success', response.data.message)
        })
    },
    /** Assign extra data before send request */
    assignBeforeSend() {
      this.selectedComponents.forEach(component => {
        this.learningSection.components.push(component.id);
      });
      this.selectedCompetences.forEach(competence => {
        this.learningSection.competences.push(competence.id);
      });
      this.selectedIndicators.forEach(indicator => {
        this.learningSection.indicators.push(indicator.id);
      });
    },
    /** Clean the learning section property and extra content */
    resetForm() {
      for (let property in this.learningSection) {
        if (this.learningSection[property] instanceof Array) {
          this.learningSection[property] = []
        }
        else {
          this.learningSection[property] = "";
        }
      }
      this.selectedComponents = [];
      this.selectedCompetences = [];
      this.selectedIndicators = [];
    },
    setInitialDates() {
      this.learningSection.start_date = moment().format('YYYY-MM-DD')
      this.learningSection.end_date = moment().add(1, 'w').format('YYYY-MM-DD')
    }
  },
  computed: {
    enableComponents() {
      return !this.components.length
    },
    enableCompetences() {
      return (!this.selectedComponents || !this.competences.length)
    },
    enableIndicators() {
      return (!this.selectedCompetences || !this.indicators.length)
    },
    /** The form is not actionable if we don't have components or competences or indicators */
    formActionable () {
      return !this.components.length > 0 || !this.competences.length > 0 || !this.indicators.length > 0
    }
  },
  watch: {
    /**
     * Initially ova property is undefined, so:
     * Watching when ova property change, if it does then call the method getComponents */
    ova() {
      this.getComponents()
    }
  }
};
</script>
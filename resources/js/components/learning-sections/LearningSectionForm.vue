<template>
  <form @submit.prevent="postLerningSection">
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
    <div class="field is-horizontal">
       <div class="field-label is-normal">
        <label class="label">Recursos</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input type="text" class="input is-small" @keydown.enter.prevent="addResource(currentResource)" v-model="currentResource" placeholder="Url">
          </div>
        </div>
        <div class="field">
          <div class="control">
            <button type="button" class="button is-primary is-small" :disabled="currentResource.length < 3" @click="addResource(currentResource)">+</button>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
       <div class="field-label is-normal">
        <label class="label">Recursos actuales</label>
      </div>
      <div class="field-body">
        <div class="field is-size-7">
          <ul v-if="learningSection.resources.length">
            <li v-for="resource in learningSection.resources" :key="resource.url">
                <p>{{resource.url}} <a href="#" @click.prevent="deleteResource(resource)"><i class="fa fa-minus-circle has-text-danger is-size-5"></i></a></p>
              </li>
          </ul>
          <p class="is-size-7" v-else>Actualmente no se han agregado url's a recursos externos</p>
        </div>
      </div>
    </div>

    <div class="field is-horizontal">
       <div class="field-label is-normal">
        <label class="label">Ref. bibliográficas</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input type="text" class="input is-small" @keydown.enter.prevent="addBibliography(currentBibliography)" v-model="currentBibliography" placeholder="Referencia">
          </div>
        </div>
        <div class="field">
          <div class="control">
            <button type="button" class="button is-primary is-small" :disabled="currentBibliography.length < 3" @click="addBibliography(currentBibliography)">+</button>
          </div>
        </div>
      </div>
    </div>

    <div class="field is-horizontal">
       <div class="field-label is-normal">
        <label class="label">Ref. bibliográficas actuales</label>
      </div>
      <div class="field-body">
        <div class="field is-size-7">
          <ul v-if="learningSection.bibliographies.length">
            <li v-for="bibliography in learningSection.bibliographies" :key="bibliography.url">
                <p>{{bibliography.url}} <a href="#" @click.prevent="deleteBibliography(bibliography)"><i class="fa fa-minus-circle has-text-danger is-size-5"></i></a></p>
              </li>
          </ul>
          <p class="is-size-7" v-else>Actualmente no se han agregado url's a refs. bibliográficas</p>
        </div>
      </div>
    </div>

    <homework-form @homeworks="learningSection.homeworks=$event"></homework-form>
   
    <div class="control has-text-right">
      <button type="submit" class="button is-primary" :disabled="formActionable">Agregar</button>
      <button type="button" class="button is-danger" @click="$emit('cancel')">Cancelar</button>
    </div>
  </form>
</template>

<script>
import HomeworkForm from '../homeworks/HomeworkForm.vue'
export default {
  props: ['ova'],
  components: {HomeworkForm},
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
      currentResource: "",
      currentBibliography:"",
    };
  },
  created() {
    this.getData();
    this.setInitialDates()
  },
  methods: {
    getData() {
      axios.all([this.getComponents()]).then(
        axios.spread(components => {
          this.components = components.data;
        })
      );
    },
    getComponents() {
      return axios.get(`/ovas/${this.ova.id}/components`);
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
    postLerningSection() {
      //Set learning section's foreign keys after we make request
      this.learningSection.ova_id = this.ova.id;

      this.selectedComponents.forEach(component => {
        this.learningSection.components.push(component.id);
      });
      this.selectedCompetences.forEach(competence => {
        this.learningSection.competences.push(competence.id);
      });
      this.selectedIndicators.forEach(indicator => {
        this.learningSection.indicators.push(indicator.id);
      });

      // Make post request
      axios.post("/learning-sections", this.learningSection).then(response => {
        console.log(response.data.message);
        this.resetForm();
        this.$emit("success");
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
    },
    addResource(url) {
      this.learningSection.resources.push({url})
      this.currentResource = ""
    },
    deleteResource(resource) {
      let index = this.learningSection.resources.indexOf(resource)
      this.learningSection.resources.splice(index,1)
    },
    addBibliography(url) {
      this.learningSection.bibliographies.push({url})
      this.currentBibliography = ""
    },
    deleteBibliography(bibliograhphy) {
      let index = this.learningSection.bibliographies.indexOf(bibliograhphy)
      this.learningSection.bibliographies.splice(index,1)
    },
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
  }
};
</script>
<template>
  <form @submit.prevent="postComponent">
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Área</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <multiselect v-model="selectedArea" :options="areas" label="name" placeholder="Seleccione área"></multiselect>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Grado</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <multiselect v-model="selectedGrade" track-by="name" :options="grades" :multiple="true"
            :close-on-select="false" :clear-on-select="false" label="name" placeholder="Seleccione grado">
                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} grados seleccionados</span></template>
            </multiselect>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Componente</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input class="input" v-model="component.name" type="text" placeholder="Nombre" />
          </div>
        </div>
      </div>
    </div>
    <div class="control has-text-right">
      <button type="submit" class="button is-primary">Agregar</button>
      <button type="button" class="button is-danger" @click="$emit('cancel')">Cancelar</button>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      areas: [],
      grades: [],
      selectedArea: "",
      selectedGrade: [],
      component: {
          id: '',
          name: '',
          mandatory_area_id: '',
          grades:[]
      }
    };
  },
  created() {
    this.getData();
  },
  methods: {
    getData() {
      axios.all([this.getAreas(), this.getGrades()]).then(
        axios.spread((areas, grades) => {
          this.areas = areas.data;
          this.grades = grades.data;
        })
      );
    },
    getAreas() {
      return axios.get("/mandatory-areas");
    },
    getGrades() {
      return axios.get("/grades");
    },
    postComponent() {
        this.selectedGrade.forEach(grade => {
            this.component.grades.push(grade.id)
        })
        this.component.mandatory_area_id = this.selectedArea.id
        axios.post('/components', this.$data.component).then(response => {
            console.log(response.data.message)
            this.resetForm()
            this.$emit('success')
        })
    },
    resetForm() {
        this.component= {
          id: '',
          name: '',
          mandatory_area_id: '',
          grades:[]
      }
    }
  }
};
</script>
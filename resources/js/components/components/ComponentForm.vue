<template>
  <form @submit.prevent="makeRequest">
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Área</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <multiselect selectLabel="Presione enter" selectedLabel="Actual" deselectLabel="Presione enter" name="area" v-model="selectedArea" v-validate="'required'" data-vv-as="area" :options="areas" track-by="name" label="name" placeholder="Seleccione área">
              <template slot="noResult">Sin resultados</template>
            </multiselect>
             <small class="help is-danger" v-if="errors.has('area')">{{errors.first('area')}}</small>
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
            <multiselect selectedLabel="Actual" selectLabel="Presione enter" deselectLabel="Presione enter" v-model="selectedGrade" track-by="name" :options="grades" :multiple="true"
            :close-on-select="false" :clear-on-select="false" label="name" placeholder="Seleccione grado">
                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} grados seleccionados</span></template>
                
                <template slot="noResult">Sin resultados</template>

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
            <input class="input" v-validate="'required|min:3'" data-vv-as="componente" v-model="component.name" type="text" name="component" placeholder="Nombre" />
             <small class="help is-danger" v-if="errors.has('component')">{{errors.first('component')}}</small>
          </div>
        </div>
      </div>
    </div>
    <div class="control has-text-right">
      <button :disabled="disableButton || errors.any()" type="submit" class="button is-primary">Agregar</button>
      <button type="button" class="button is-danger" @click="$emit('cancel')">Cancelar</button>
    </div>
  </form>
</template>

<script>
import {permissionsMixin} from '../../mixins/PermissionsMixin'
export default {
  mixins:[permissionsMixin],
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
      },
      disableButton:false
    };
  },
  created() {
    this.getData();
  },
  mounted() {
    setTimeout(() => {
      this.disableButton = !this.$can('create components')
    }, 2000);
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
      return axios.get("/app/mandatory-areas/all");
    },
    getGrades() {
      return axios.get("/app/grades/all");
    },
    makeRequest() {
      if (this.component.id) {
        this.putComponent()
      } else {
        this.postComponent()
      } 
    },
    postComponent() {
      this.assignBeforeSend()
      axios.post('/components', this.component).then(response => {
        console.log(response.data.message)
        this.resetForm()
        this.$emit('success', response.data.message)
      })
    },
    putComponent() {
      this.assignBeforeSend()
      axios.put(`/components/${this.component.id}`,this.component).then(response => {
        console.log(response.data.message)
        this.resetForm()
        this.$emit('success', response.data.message)
      })
    },
    assignBeforeSend() {
      if (this.component.grades.length) this.component.grades = [] 
      this.selectedGrade.forEach(grade => {
        this.component.grades.push(grade.id)
      })
      this.component.mandatory_area_id = this.selectedArea.id
    },
    resetForm() {
        this.component= {
          id: '',
          name: '',
          mandatory_area_id: '',
          grades:[]
      }
      this.selectedArea = ""
      this.selectedGrade = []
    }
  }
};
</script>
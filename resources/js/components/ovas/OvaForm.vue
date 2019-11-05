<template>
  <form @submit.prevent="makeRequest">
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Área</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <multiselect
              v-model="selectedArea"
              :options="areas"
              label="name"
              @input="getSubjects(selectedArea)"
              placeholder="Seleccione área"
            ></multiselect>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Asignatura</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <multiselect
              v-model="selectedSubject"
              :options="subjects"
              :disabled="(!selectedArea || !subjects.length)"
              label="name"
              placeholder="Seleccione asignatura"
            ></multiselect>
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
            <multiselect
              v-model="selectedGrade"
              track-by="name"
              :options="grades"
              label="name"
              @input="getClasses(selectedGrade)"
              placeholder="Seleccione grado"
            >
            </multiselect>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Clase</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <multiselect
              v-model="selectedClass"
              track-by="name"
              :options="classes"
              :disabled="(!selectedGrade || !classes.length)"
              label="name"
              placeholder="Seleccione clase"
            >
            </multiselect>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Tema y periodo</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input class="input" v-model="ova.theme" type="text" placeholder="Nombre" />
          </div>
        </div>
        <div class="field">
          <div class="control">
            <div class="select">
              <select v-model="ova.period">
                <option v-for="(period,index) in periods" :key="index" :value="period">{{period}}</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="control has-text-right">
      <button :disabled="disableButton" type="submit" class="button is-primary">Agregar</button>
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
      subjects:[],
      grades: [],
      classes: [],
      periods: [1, 2, 3, 4],
      selectedArea: "",
      selectedSubject:"",
      selectedGrade: "",
      selectedClass: "",
      ova: {
        id: "",
        period: 1,
        theme: "",
        mandatory_area_id: "",
        subject_id: "",
        grade_id: "",
        class_id: "",
      },
      disableButton:false
    };
  },
  created() {
    this.getData();
  },
  mounted() {
    setTimeout(() => {
      this.disableButton = !this.$can('create ovas')
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
      return axios.get("/mandatory-areas");
    },
    getSubjects(area){
      this.subjects = area.subjects
    },
    getGrades() {
      return axios.get("/grades");
    },
    getClasses(grade) {
      this.classes = grade.classes
    },
    makeRequest() {
      if (this.ova.id) {
        this.putOva()
      } else {
        this.postOva()
      }
    },
    postOva() {
      this.assignBeforeSend()
      axios.post("/ovas", this.ova).then(response => {
        console.log(response.data.message);
        this.resetForm();
        this.$emit("success");
      });
    },
    putOva() {
      this.assignBeforeSend()
      axios.put(`/ovas/${this.ova.id}`, this.ova).then(response => {
        console.log(response.data.message)
        this.resetForm()
        this.$emit('success')
      })
    },
    assignBeforeSend() {
      //Set ova's foreign keys
      this.ova.mandatory_area_id = this.selectedArea.id;
      this.ova.subject_id = this.selectedSubject.id
      this.ova.grade_id = this.selectedGrade.id
      this.ova.class_id = this.selectedClass.id
    },
    resetForm() {
      for (let property in this.ova) {
          this.ova[property] = ""
      }
      this.selectedArea= ""
      this.selectedSubject=""
      this.selectedGrade= ""
      this.selectedClass= ""
    }
  }
};
</script>
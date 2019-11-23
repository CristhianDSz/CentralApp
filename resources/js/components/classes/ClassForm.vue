<template>
  <form @submit.prevent="postClass">
    <div class="field">
      <p class="control has-icons-left has-icons-right">
        <input
          class="input"
          v-validate="'required|min:3'"
          data-vv-as="curso"
          name="schoolClass"
          type="text"
          v-model="schoolClass.name"
          placeholder="Nombre de la clase"
        />
         <small class="help is-danger" v-if="errors.has('schoolClass')">{{errors.first('schoolClass')}}</small>
      </p>
    </div>
    <div class="field">
      <div class="control">
        <div class="select">
          <select v-model="schoolClass.grade_id">
            <option v-for="grade in grades" :key="grade.id" :value="grade.id">{{grade.name}}</option>
          </select>
        </div>
      </div>
    </div>
    <div class="field">
      <p class="control">
        <button :disabled="disableControls || errors.any()" class="button is-success is-fullwidth">Crear</button>
      </p>
    </div>
  </form>
</template>

<script>
import {permissionsMixin} from '../../mixins/PermissionsMixin'
export default {
  mixins:[permissionsMixin],
  data() {
    return {
      schoolClass: {
        id: "",
        name: "",
        grade_id: ""
      },
      grades:[],
      disableControls: false
    };
  },
  created() {
    //Listeting when grades are created or updated
    GradeClassEmitter.$on('grades', (grades) => {
      this.grades = grades
      this.schoolClass.grade_id = this.grades[0].id
    })
  },
  mounted() {
    setTimeout(() => {
      this.disableControls = !this.$can('create classes')
    }, 2000);
  },
  methods: {
    postClass() {
      axios.post("/classes", this.$data.schoolClass).then(response => {
        console.log(response.data.message);
        this.$emit("success", response.data.message);
        this.resetForm();
      });
    },
    resetForm() {
      this.schoolClass.id = this.schoolClass.name = ''
      this.schoolClass.grade_id = this.grades[0].id
    }
  }
};
</script>

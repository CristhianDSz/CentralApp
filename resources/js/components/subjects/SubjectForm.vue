<template>
  <form @submit.prevent="postSubject">
    <div class="field">
      <p class="control has-icons-left has-icons-right">
        <input
          class="input"
          v-validate="'required|min:3'"
          data-vv-as="asignatura"
          name="subject"
          type="text"
          v-model="subject.name"
          placeholder="Nombre de la asignatura"
        />
         <small class="help is-danger" v-if="errors.has('subject')">{{errors.first('subject')}}</small>
      </p>
    </div>
    <div class="field">
      <div class="control">
        <div class="select">
          <select v-model="subject.mandatory_area_id">
            <option v-for="area in areas" :key="area.id" :value="area.id">{{area.name}}</option>
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
      subject: {
        id: "",
        name: "",
        mandatory_area_id: ""
      },
      areas:[],
      disableControls:false
    };
  },
  created() {
    //Listeting when areas are created or updated
    SubjectAreaEmitter.$on('areas', (areas) => {
      this.areas = areas
      this.subject.mandatory_area_id = this.areas[0].id
    })
  },
  mounted() {
    setTimeout(() => {
      this.disableControls = !this.$can('create subjects')
    }, 2000);
  },
  methods: {
    postSubject() {
      axios.post("/subjects", this.$data.subject).then(response => {
        console.log(response.data.message);
        this.$emit("success", response.data.message);
        this.resetForm();
      });
    },
    resetForm() {
      this.subject.id = this.subject.name = ''
      this.subject.mandatory_area_id = this.areas[0].id
    }
  }
};
</script>

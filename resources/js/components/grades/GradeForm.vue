<template>
  <form @submit.prevent="postGrade">
    <div class="field">
      <p class="control has-icons-left has-icons-right">
        <input v-validate="'required|min:3'" data-vv-as="grado" name="grade" class="input" type="text" v-model="grade.name" placeholder="Nombre del grado" />
      </p>
       <small class="help is-danger" v-if="errors.has('grade')">{{errors.first('grade')}}</small>
    </div>
    <div class="field">
      <p class="control">
        <button :disabled="disableButton || errors.any()"  class="button is-success is-fullwidth">Crear</button>
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
      grade: {
        id: "",
        name: ""
      },
      disableButton: false
    };
  },
  /** Check for user permissions and disabled button unless user has permission */
  mounted() {
    setTimeout(() => {
      this.disableButton = !this.$can('create grades')
    }, 2000);
  },
  methods: {
    postGrade() {
      axios.post("/grades", this.$data.grade).then(response => {
        console.log(response.data.message);
        this.$emit("success", response.data.message);
        this.resetForm();
      });
    },
    resetForm() {
      this.grade = { id: "", name: "" };
    }
  }
};
</script>

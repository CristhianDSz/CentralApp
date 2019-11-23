<template>
  <form @submit.prevent="postPresentation">
    <div class="field">
      <p class="control has-icons-left has-icons-right">
        <input v-validate="'required|min:3'" data-vv-as="entregable" name="presentation" class="input" type="text" v-model="presentation.name" placeholder="Nombre del entregable" />
      </p>
       <small class="help is-danger" v-if="errors.has('presentation')">{{errors.first('presentation')}}</small>
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
      presentation: {
        id: "",
        name: ""
      },
      disableButton: false
    };
  },
  /** Check for user permissions and disabled button unless user has permission */
  mounted() {
    setTimeout(() => {
      this.disableButton = !this.$can('create presentations')
    }, 2000);
  },
  methods: {
    postPresentation() {
      axios.post("/presentations", this.$data.presentation).then(response => {
        console.log(response.data.message);
        this.$emit("success", response.data.message);
        this.resetForm();
      });
    },
    resetForm() {
      this.presentation = { id: "", name: "" };
    }
  }
};
</script>

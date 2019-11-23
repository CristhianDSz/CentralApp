<template>
  <form @submit.prevent="postArea">
    <div class="field">
      <p class="control has-icons-left has-icons-right">
        <input v-validate="'required|min:3'" data-vv-as="Área" name="area" class="input" type="text" v-model="area.name" placeholder="Nombre del área" />
         <small class="help is-danger" v-if="errors.has('area')">{{errors.first('area')}}</small>
      </p>
    </div>
    <div class="field">
      <p class="control">
        <button :disabled="disableButton || errors.any()" class="button is-success is-fullwidth">Crear</button>
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
      area: {
        id: "",
        name: ""
      },
      disableButton:false
    };
  },
  mounted() {
    setTimeout(() => {
      this.disableButton = !this.$can('create mandatory_areas')
    }, 2000);
  },
  methods: {
    postArea() {
      axios.post("/mandatory-areas", this.$data.area).then(response => {
        console.log(response.data.message);
        this.$emit("success", response.data.message);
        this.resetForm();
      });
    },
    resetForm() {
      this.area = { id: "", name: "" };
    }
  }
};
</script>

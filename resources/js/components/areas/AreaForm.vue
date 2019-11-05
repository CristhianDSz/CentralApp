<template>
  <form @submit.prevent="postArea">
    <div class="field">
      <p class="control has-icons-left has-icons-right">
        <input class="input" type="text" v-model="area.name" placeholder="Nombre del área" />
      </p>
    </div>
    <div class="field">
      <p class="control">
        <button :disabled="disableButton" class="button is-success is-fullwidth">Crear</button>
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

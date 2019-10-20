<template>
  <form @submit.prevent="postGrade">
    <div class="field">
      <p class="control has-icons-left has-icons-right">
        <input class="input" type="text" v-model="grade.name" placeholder="Nombre del grado" />
      </p>
    </div>
    <div class="field">
      <p class="control">
        <button class="button is-success is-fullwidth">Crear</button>
      </p>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      grade: {
        id: "",
        name: ""
      }
    };
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

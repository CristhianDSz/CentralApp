<template>
  <tbody>
    <grade v-for="(grade, index) in grades" :key="grade.id" :grade="grade" :index="index+1" @success="getGrades"></grade>
  </tbody>
</template>

<script>
import Grade from "./Grade.vue";
export default {
  components: { Grade },
  data() {
    return {
      grades: []
    };
  },
  created() {
    this.getGrades();
  },
  methods: {
    getGrades() {
      axios.get("/grades").then(response => {
        this.grades = response.data;
        GradeClassEmitter.$emit('grades', response.data)
      });
    }
  }
};
</script>
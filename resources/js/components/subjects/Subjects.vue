<template>
  <tbody>
    <subject v-for="(subject, index) in subjects" :key="subject.id" :subject="subject" :index="index+1" :areas="areas" @success="getSubjects"></subject>
  </tbody>
</template>

<script>
import Subject from "./Subject.vue";
export default {
  components: { Subject },
  data() {
    return {
      subjects: [],
      areas:[],
    };
  },
  created() {
    this.getSubjects();
    //Listeting when areas are created or updated
    SubjectAreaEmitter.$on('areas', (areas) => {
      this.areas = areas
    })
  },
  methods: {
    getSubjects() {
      axios.get("/subjects").then(response => {
        this.subjects = response.data;
      });
    }
  }
};
</script>
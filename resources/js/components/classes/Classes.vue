<template>
  <tbody>
    <school-class v-for="(schoolClass, index) in classes" :key="schoolClass.id" :schoolClass="schoolClass" :index="index+1" :grades="grades" @success="getClasses"></school-class>
  </tbody>
</template>

<script>
import Class from "./Class.vue";
export default {
  components: { "school-class": Class },
  data() {
    return {
      classes: [],
      grades:[],
    };
  },
  created() {
    this.getClasses();
    //Listeting when grades are created or updated
    GradeClassEmitter.$on('grades', (grades) => {
      this.grades = grades
    })
  },
  methods: {
    getClasses() {
      axios.get("/classes").then(response => {
        this.classes = response.data;
      });
    }
  }
};
</script>
<template>
  <tbody>
    <mandatory-area v-for="(area, index) in areas" :key="area.id" :area="area" :index="index+1" @success="getAreas"></mandatory-area>
  </tbody>
</template>

<script>
import Area from "./Area.vue";
export default {
  components: { "mandatory-area": Area },
  data() {
    return {
      areas: []
    };
  },
  created() {
    this.getAreas();
  },
  methods: {
    getAreas() {
      axios.get("/mandatory-areas").then(response => {
        this.areas = response.data;
        SubjectAreaEmitter.$emit('areas', response.data)
      });
    }
  }
};
</script>
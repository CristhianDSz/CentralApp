<template>
  <div class="columns">
    <div class="column" v-for="learningSection in learningSections" :key="learningSection.id">
      <learning-section :learningSection="learningSection"></learning-section>
    </div>
  </div>
</template>

<script>
import LearningSection from './LearningSection.vue'
export default {
    props:['learningSections'],
    components:{LearningSection}
};
</script>
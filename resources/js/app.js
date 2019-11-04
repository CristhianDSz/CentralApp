require('./bootstrap')

import Vue from 'vue'
import Multiselect from 'vue-multiselect'

Vue.component('multiselect', Multiselect)

import AreasMain from './components/areas/AreasMain.vue'
import SubjectsMain from './components/subjects/SubjectsMain.vue'
import GradesMain from './components/grades/GradesMain.vue'
import ClassesMain from './components/classes/ClassesMain.vue'
import ComponentsMain from './components/components/ComponentsMain.vue'
import OvasMain from './components/ovas/OvasMain.vue'

//Buses
window.SubjectAreaEmitter = new Vue()
window.GradeClassEmitter = new Vue()
window.ComponentEmitter = new Vue()
window.CompetenceComponentEmitter = new Vue()
window.OvaEmitter = new Vue()
window.OvaLearningEmitter = new Vue()

// Navbar section
const navMenu = new Vue({
  el: '#navMenu',
  data() {
    return {
      navbarDropdown: false
    }
  }
})

const app = new Vue({
    el: '#app',
    components: {
        AreasMain,
        SubjectsMain,
        GradesMain,
        ClassesMain,
        ComponentsMain,
        OvasMain
    }
})

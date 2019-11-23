require('./bootstrap')

import Vue from 'vue'
import VueSweetalert2 from "vue-sweetalert2";
import Multiselect from 'vue-multiselect'
import VeeValidate, { Validator } from "vee-validate";
import es from "vee-validate/dist/locale/es";

Vue.component('multiselect', Multiselect)
import "sweetalert2/dist/sweetalert2.min.css";

Vue.use(VueSweetalert2);
Validator.localize({ es: es });
Vue.use(VeeValidate, {
    locale: "es",
    fieldsBagName: "vvFields",
    events: "change|focus|input|blur"
});

import AreasMain from './components/areas/AreasMain.vue'
import SubjectsMain from './components/subjects/SubjectsMain.vue'
import GradesMain from './components/grades/GradesMain.vue'
import ClassesMain from './components/classes/ClassesMain.vue'
import ComponentsMain from './components/components/ComponentsMain.vue'
import OvasMain from './components/ovas/OvasMain.vue'
import PresentationsMain from './components/presentations/PresentationsMain.vue'

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
        OvasMain,
        PresentationsMain
    }
})

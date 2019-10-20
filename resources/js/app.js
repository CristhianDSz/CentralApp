require('./bootstrap');

import Vue from 'vue'


import AreasMain from './components/areas/AreasMain.vue';
import SubjectsMain from './components/subjects/SubjectsMain.vue'
import GradesMain from './components/grades/GradesMain.vue'
import ClassesMain from './components/classes/ClassesMain.vue'

//Buses
window.SubjectAreaEmitter = new Vue()
window.GradeClassEmitter = new Vue()

const app = new Vue({
    el:"#app",
    components: {AreasMain,SubjectsMain,GradesMain,ClassesMain}

})

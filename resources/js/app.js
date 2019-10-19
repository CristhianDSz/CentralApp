require('./bootstrap');

import Vue from 'vue'


import AreasMain from './components/areas/AreasMain.vue';
import SubjectsMain from './components/subjects/SubjectsMain.vue'

//Buses
window.SubjectAreaEmitter = new Vue();

const app = new Vue({
    el:"#app",
    components: {AreasMain,SubjectsMain}

})

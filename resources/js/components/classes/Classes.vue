<template>
  <div class="column is-12">
    <table
      class="table is-hoverable is-bordered is-fullwidth dataTable no-footer"
      id="datatable"
      role="grid"
      aria-describedby="datatable_info"
    >
      <thead>
        <tr role="row">
          <th style="width: 105.2px;">No</th>
          <th style="width: 529.2px;">Nombre de clase</th>
          <th style="width: 529.2px;">Grado</th>
          <th style="width: 198.2px;">Acción</th>
        </tr>
      </thead>
      <tbody>
        <school-class
          v-for="(schoolClass, index) in classes"
          :key="schoolClass.id"
          :schoolClass="schoolClass"
          :index="index+1"
          :grades="grades"
          @success="getClasses"
        ></school-class>
      </tbody>
    </table>
    <pagination ref="classesPagination" @page="goToPage"></pagination>
  </div>
</template>

<script>
import Class from "./Class.vue";
import Pagination from '../utils/Pagination.vue'
export default {
  components: { "school-class": Class, Pagination },
  data() {
    return {
      classes: [],
      grades: []
    };
  },
  created() {
    this.getClasses();
    //Listeting when grades are created or updated
    GradeClassEmitter.$on("grades", grades => {
      this.grades = grades;
    });
  },
  methods: {
    goToPage(page) {
      this.getClasses(page);
    },
    getClasses(page = 1) {
      axios.get("/classes?page=" + page).then(response => {
        this.$refs.classesPagination.setPagination(response)
        this.classes = response.data.data;
        this.$refs.classesPagination.getPagesNumber();
      });
    },
  }
};
</script>
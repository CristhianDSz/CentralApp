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
          <th style="width: 529.2px;">Name</th>
          <th style="width: 529.2px;">Área</th>
          <th style="width: 198.2px;">Action</th>
        </tr>
      </thead>
      <tbody>
        <subject
          v-for="(subject, index) in subjects"
          :key="subject.id"
          :subject="subject"
          :index="index+1"
          :areas="areas"
          @success="getSubjects"
        ></subject>
      </tbody>
    </table>
    <pagination ref="subjectsPagination" @page="goToPage"></pagination>
  </div>
</template>

<script>
import Subject from "./Subject.vue";
import Pagination from '../utils/Pagination.vue'
export default {
  components: { Subject, Pagination },
  data() {
    return {
      subjects: [],
      areas: []
    };
  },
  created() {
    this.getSubjects();
    //Listeting when areas are created or updated
    SubjectAreaEmitter.$on("areas", areas => {
      this.areas = areas;
    });
  },
  methods: {
    goToPage(page) {
      this.getSubjects(page)
    },
    getSubjects(page = 1) {
      axios.get("/subjects?page=" + page).then(response => {
        this.$refs.subjectsPagination.setPagination(response)
        this.$refs.subjectsPagination.getPagesNumber();
        this.subjects = response.data.data;
      });
    }
  }
};
</script>
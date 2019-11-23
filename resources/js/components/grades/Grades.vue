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
          <th style="width: 198.2px;">Action</th>
        </tr>
      </thead>
      <tbody>
        <grade
          v-for="(grade, index) in grades"
          :key="grade.id"
          :grade="grade"
          :index="index+1"
          @success="getGrades"
        ></grade>
      </tbody>
    </table>
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
      <a
        class="pagination-previous"
        v-if="pagination.current_page > 1"
        @click.prevent="goToPage(pagination.current_page - 1)"
      >Anterior</a>

      <a class="pagination-next" v-if="pagination.current_page < pagination.last_page" @click.prevent="goToPage(pagination.current_page + 1)">Siguiente</a>
      <ul class="pagination-list">
        <li v-for="(page,index) in pagesNumber" :key="index">
          <a class="pagination-link" :class="{'is-current': page === pagination.current_page}" aria-label="Goto page 1" @click.prevent="goToPage(page)">{{page}}</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import Grade from "./Grade.vue";
export default {
  components: { Grade },
  data() {
    return {
      grades: [],
      pagination: {},
      pagesNumber: 0
    };
  },
  created() {
    this.getGrades();
  },
  methods: {
    goToPage(page) {
      this.getGrades(page);
    },
    getGrades(page = 1) {
      axios.get("/grades?page=" + page).then(response => {
        this.pagination.next_page_url = response.data.next_page_url;
        this.pagination.prev_page_url = response.data.prev_page_url;
        this.pagination.last_page_url = response.data.last_page_url;
        this.pagination.current_page = response.data.current_page;
        this.pagination.last_page = response.data.last_page;
        this.pagination.total = response.data.total;
        this.pagination.from = response.data.from;
        this.pagination.to = response.data.total;
        this.grades = response.data.data;
        this.getPagesNumber();
        this.getAllGrades();
      });
    },
    getPagesNumber() {
      let from = this.pagination.current_page - 3;
      if (from < 1) {
        from = 1;
      }

      let to = from + 3 * 2;

      if (to > this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      let pagesArray = [];

      while (from <= to) {
        pagesArray.push(from);
        from++;
      }

      this.pagesNumber = pagesArray;
    },
    getAllGrades() {
      axios.get("/app/grades/all").then(grades => {
        GradeClassEmitter.$emit("grades", grades.data);
      });
    }
  }
};
</script>
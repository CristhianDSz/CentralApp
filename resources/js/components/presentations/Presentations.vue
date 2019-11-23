<template>
  <div class="column is-12">
    <table
      class="table is-hoverable is-bordered is-fullwidth dataTable no-footer"
      id="datatable"
      role="grid"
      aria-describedby="datatable_info"
      v-if="presentations.length"
    >
      <thead>
        <tr role="row">
          <th style="width: 105.2px;">No</th>
          <th style="width: 529.2px;">Entregable</th>
          <th style="width: 198.2px;">Acción</th>
        </tr>
      </thead>
      <tbody>
        <presentation
          v-for="(presentation, index) in presentations"
          :key="presentation.id"
          :presentation="presentation"
          :index="index+1"
          @success="getPresentations"
        ></presentation>
      </tbody>
    </table>
    <div class="message is-warning" v-else>
      <p class="message-body">
        Actualmente no existen entregables registrados.
      </p>
    </div>
    <nav class="pagination is-centered" role="navigation" aria-label="pagination" v-show="presentations.length">
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
import Presentation from "./Presentation.vue";
export default {
  components: { Presentation },
  data() {
    return {
      presentations: [],
      originalPresentations:[],
      pagination: {},
      pagesNumber: 0
    };
  },
  created() {
    this.getPresentations();
  },
  methods: {
    goToPage(page) {
      this.getPresentations(page);
    },
    getPresentations(page = 1) {
      axios.get("/presentations?page=" + page).then(response => {
        this.pagination.next_page_url = response.data.next_page_url;
        this.pagination.prev_page_url = response.data.prev_page_url;
        this.pagination.last_page_url = response.data.last_page_url;
        this.pagination.current_page = response.data.current_page;
        this.pagination.last_page = response.data.last_page;
        this.pagination.total = response.data.total;
        this.pagination.from = response.data.from;
        this.pagination.to = response.data.total;
        this.presentations = response.data.data;
        this.originalPresentations = response.data.data
        this.getPagesNumber();
        this.getAllPresentations();
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
    getAllPresentations() {
      axios.get("/app/presentations/all").then(presentations => {
        GradeClassEmitter.$emit("presentations", presentations.data);
      });
    }
  }
};
</script>
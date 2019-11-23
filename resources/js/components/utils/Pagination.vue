<template>
  <nav class="pagination is-centered" role="navigation" aria-label="pagination">
    <a
      class="pagination-previous"
      v-if="pagination.current_page > 1"
      @click.prevent="goToPage(pagination.current_page - 1)"
    >Anterior</a>

    <a
      class="pagination-next"
      v-if="pagination.current_page < pagination.last_page"
      @click.prevent="goToPage(pagination.current_page + 1)"
    >Siguiente</a>
    <ul class="pagination-list">
      <li v-for="(page,index) in pagesNumber" :key="index" style="list-style:none">
        <a
          class="pagination-link"
          :class="{'is-current': page === pagination.current_page}"
          aria-label="Goto page 1"
          @click.prevent="goToPage(page)"
        >{{page}}</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      pagination: {},
      pagesNumber: 0,
      methodGet: ""
    };
  },
  methods: {
    setPagination(response) {
      this.pagination.next_page_url = response.data.next_page_url;
      this.pagination.prev_page_url = response.data.prev_page_url;
      this.pagination.last_page_url = response.data.last_page_url;
      this.pagination.current_page = response.data.current_page;
      this.pagination.last_page = response.data.last_page;
      this.pagination.total = response.data.total;
      this.pagination.from = response.data.from;
      this.pagination.to = response.data.total;
    },
    goToPage(page) {
      this.$emit('page',page);
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
    }
  }
};
</script>
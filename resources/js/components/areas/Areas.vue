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
        <mandatory-area
          v-for="(area, index) in areas"
          :key="area.id"
          :area="area"
          :index="index+1"
          @success="getAreas"
        ></mandatory-area>
      </tbody>
    </table>
    <pagination ref="areasPagination" @page="goToPage"></pagination>
  </div>
</template>

<script>
import Area from "./Area.vue";
import Pagination from "../utils/Pagination.vue";
export default {
  components: { "mandatory-area": Area, Pagination },
  data() {
    return {
      areas: []
    };
  },
  created() {
    this.getAreas();
  },
  methods: {
     goToPage(page) {
      this.getAreas(page);
    },
    getAreas(page = 1) {
      axios.get("/mandatory-areas?page=" + page).then(response => {
        this.$refs.areasPagination.setPagination(response)
        this.areas = response.data.data;
        this.$refs.areasPagination.getPagesNumber();
        this.getAllAreas()
      });
    },
    getAllAreas() {
      axios.get("/app/mandatory-areas/all").then(areas => {
        SubjectAreaEmitter.$emit("areas", areas.data);
      });
    }
  }
};
</script>
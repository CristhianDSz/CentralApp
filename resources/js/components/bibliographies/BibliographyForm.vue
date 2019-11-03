<template>
  <div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Ref. bibliográficas</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              type="text"
              class="input is-small"
              @keydown.enter.prevent="addBibliography(bibliography.url)"
              v-model="bibliography.url"
              placeholder="Referencia"
            />
          </div>
        </div>
        <div class="field">
          <div class="control">
            <button
              type="button"
              class="button is-primary is-small"
              :disabled="bibliography.url.length < 3"
              @click="addBibliography(bibliography.url)"
            >+</button>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Ref. bibliográficas actuales</label>
      </div>
      <div class="field-body">
        <div class="field is-size-7">
          <ul v-if="bibliographies.length">
            <li v-for="bibliography in bibliographies" :key="bibliography.url">
              <p>
                {{bibliography.url}}
                <a href="#" @click.prevent="deleteBibliography(bibliography)">
                  <i class="fa fa-minus-circle has-text-danger is-size-5"></i>
                </a>
              </p>
            </li>
          </ul>
          <p class="is-size-7" v-else>Actualmente no se han agregado url's a refs. bibliográficas</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      bibliography: {
        id: "",
        url: "",
        learning_section_id: ""
      },
      bibliographies:[]
    };
  },
  methods: {
    addBibliography(url) {
      if (this.$parent.learningSection.id) {
        const bibliography = {
          learning_section_id: this.$parent.learningSection.id,
          url
        };
        axios.post("/bibliographies", bibliography).then(response => {
          this.bibliographies.push(response.data.bibliography);
        });
      } else {
        this.bibliographies.push({ url });
      }
      this.$emit('bibliographies',this.bibliographies)
    },
    deleteBibliography(bibliography) {
      if (this.$parent.learningSection.id) {
        const tempBibliography = bibliography;
        axios
          .delete(`/bibliographies/${tempBibliography.id}`)
          .then(response => {
            console.log(response.data.message);
          });
      }
      let index = this.bibliographies.indexOf(bibliography);
      this.bibliographies.splice(index, 1);
      this.$emit('bibliographies',this.bibliographies)
    }
  }
};
</script>
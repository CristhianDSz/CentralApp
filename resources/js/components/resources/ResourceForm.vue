<template>
  <div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Recursos</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              type="text"
              class="input is-small"
              @keydown.enter.prevent="addResource(resource.url)"
              v-model="resource.url"
              placeholder="Url"
            />
          </div>
        </div>
        <div class="field">
          <div class="control">
            <button
              type="button"
              class="button is-primary is-small"
              :disabled="resource.url.length < 3"
              @click="addResource(resource.url)"
            >+</button>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Recursos actuales</label>
      </div>
      <div class="field-body">
        <div class="field is-size-7">
          <ul v-if="resources.length">
            <li v-for="resource in resources" :key="resource.url">
              <p>
                {{resource.url}}
                <a href="#" @click.prevent="deleteResource(resource)">
                  <i class="fa fa-minus-circle has-text-danger is-size-5"></i>
                </a>
              </p>
            </li>
          </ul>
          <p class="is-size-7" v-else>Actualmente no se han agregado url's a recursos externos</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      resource: {
        id: "",
        url: "",
        learning_section_id: ""
      },
      resources:[],
    };
  },
  methods: {
    addResource(url) {
      if (this.$parent.learningSection.id) {
        const resource = { learning_section_id: this.$parent.learningSection.id, url };
        axios.post("/resources", resource).then(response => {
          this.resources.push(response.data.resource);
        });
      } else {
        this.resources.push({ url });
      }
      this.$emit("resources", this.resources);
      this.resetForm()
    },
    deleteResource(resource) {
      if (this.$parent.learningSection.id) {
        const tempResource = resource;
        axios.delete(`/resources/${tempResource.id}`).then(response => {
          console.log(response.data.message);
        });
      }
      let index = this.resources.indexOf(resource);
      this.resources.splice(index, 1);
      this.$emit("resources", this.resources);
    },
    resetForm() {
      for (let property in this.resource) {
          this.resource[property] = ""
      }
    }
  }
};
</script>

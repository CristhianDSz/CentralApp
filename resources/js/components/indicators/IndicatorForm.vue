<template>
  <form @submit.prevent="makeRequest">
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label is-size-6">Indicador</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <textarea class="textarea" v-model="indicator.name" placeholder="Nombre"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="control has-text-right">
      <button type="submit" class="button is-primary">Agregar</button>
      <button type="button" class="button is-danger" @click="$emit('cancel')">Cancelar</button>
    </div>
  </form>
</template>

<script>
export default {
  props: ["competence"],
  data() {
    return {
      indicator: {
        id: "",
        name: "",
        competence_id: ""
      }
    };
  },
  methods: {
    makeRequest() {
      if (this.indicator.id) {
        this.putIndicator()
      } else {
        this.postIndicator()
      }
    },
    postIndicator() {
      this.indicator.competence_id = this.competence.id
      axios.post('/indicators',this.$data.indicator).then(response => {
        this.$emit('success')
        this.resetForm()
      })
    },
    putIndicator() {
      axios.put(`/indicators/${this.indicator.id}`, this.indicator).then(response => {
        console.log(response.data.messagae)
        this.$emit('success')
        this.resetForm()
      })
    },
    resetForm() {
      for (const property in this.indicator) {
        this.indicator[property] = ''
      }
    }
  }
};
</script>
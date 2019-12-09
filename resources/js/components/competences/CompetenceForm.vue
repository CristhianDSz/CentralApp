<template>
  <form @submit.prevent="makeRequest">
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label is-size-6">Competencia</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <textarea v-validate="'required|min:3'" data-vv-as="competencia" class="textarea" name="competence" v-model="competence.name" placeholder="Nombre"></textarea>
            <small class="help is-danger" v-if="errors.has('competence')">{{errors.first('competence')}}</small>
          </div>
        </div>
      </div>
    </div>
    <div class="control has-text-right">
      <button type="submit" :disabled="errors.any()" class="button is-primary">Agregar</button>
      <button type="button" class="button is-danger" @click="$emit('cancel')">Cancelar</button>
    </div>
  </form>
</template>

<script>
export default {
  props: ["component"],
  data() {
    return {
      competence: {
        id: "",
        name: "",
        component_id: ""
      }
    };
  },
  methods: {
    makeRequest() {
      if (this.competence.id) {
        this.putCompetence()
      } else {
        this.postCompetence()
      }
    },
    postCompetence() {
      this.competence.component_id = this.component.id
      axios.post('/competences',this.$data.competence).then(response => {
        this.$emit('success', response.data.message)
        this.resetForm()
      })
    },
    putCompetence() {
      axios.put(`/competences/${this.competence.id}`, this.competence).then(response => {
        console.log(response.data.message)
        this.$emit('success', response.data.message)
        this.resetForm()
      })
    },
    resetForm() {
      for (const property in this.competence) {
        this.competence[property] = ''
      }
    }
  }
};
</script>
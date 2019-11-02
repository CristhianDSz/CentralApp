<template>
  <div class="is-inline">
    <p>
      <span>{{indicator.name}}</span>
      <a href="#" @click.prevent="editIndicator(indicator)"><i class="fa fa-edit has-text-primary is-size-5"></i></a>
      <a href="#" @click.prevent="deleteIndicator(indicator)"><i class="fa fa-trash has-text-danger is-size-5"></i></a>
    </p>
  </div>
</template>

<script>
export default {
    props:['indicator'],
    methods: {
      editIndicator(indicator) {
        CompetenceComponentEmitter.$emit('edit-indicator', indicator)
      },
      deleteIndicator(indicator) {
        axios.delete(`/indicators/${indicator.id}`).then(response => {
          console.log(response.data.message)
          CompetenceComponentEmitter.$emit('indicator-deleted')
        })
      }
    }
};
</script>
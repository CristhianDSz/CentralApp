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
        this.$swal
        .fire({
          title: "Está seguro(a)?",
          text: "Este cambio no se podrá revertir!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, eliminar!",
          cancelButtonText: "Cancelar"
        }).then(result => {
          if (result.value) {
            axios.delete(`/indicators/${indicator.id}`).then(response => {
              this.$swal.fire('Eliminado!', response.data.message,'success')
              CompetenceComponentEmitter.$emit('indicator-deleted')
            })
          }
        })
      }
    }
};
</script>
<template>
  <div class="is-inline">
    <p>{{competence.name}}</p>
    <a href="#" @click.prevent="$emit('indicator', competence)">Agregar indicador(es)</a>
  </div>
</template>

<script>
export default {
    props:['competence']
};
</script>
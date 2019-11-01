<template>
  <div class="modal" :class="{'is-active': modalActive}">
    <div class="modal-background"></div>
    <div class="modal-card" :class="{'is-large': large }">
      <header class="modal-card-head">
        <p class="modal-card-title is-size-7 has-text-weight-medium">
          <slot name="title"></slot>
        </p>
        <button class="delete" aria-label="close" @click="$emit('close')"></button>
      </header>
      <section class="modal-card-body">
        <slot name="body"></slot>
      </section>
      <footer class="modal-card-foot"></footer>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    modalActive: Boolean,
    large: Boolean
  }
};
</script>
<style scoped>
  .is-large {
    width: 1024px;
  }
</style>
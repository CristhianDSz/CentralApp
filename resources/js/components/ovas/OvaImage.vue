<template>
  <modal :modalActive="modalActive" :large="true" @close="modalActive=!modalActive">
    <template slot="title">Agregar o actualizar imagen de Objeto de Aprendizaje</template>
    <template slot="body">
      <p
        class="has-text-centered help"
      >Puede agregar o modificar una imagen de portada para el objeto de aprendizaje para fines de presentación.</p>
      <p class="help has-text-danger has-text-centered" v-if="showError">{{defaultError}}</p>
      <div class="row">
        <div id="preview"></div>
      </div>
      <form @submit.prevent="uploadImage" class="is-size-7">
        <div class="field">
          <div class="file">
            <label class="file-label">
              <input
                class="file-input"
                type="file"
                id="file"
                ref="file"
                name="image"
                @change="onChangeImageUpload"
              />
              <span class="file-cta">
                <span class="file-icon">
                  <i class="fa fa-upload"></i>
                </span>
                <span class="file-label">Seleccione imagen</span>
              </span>
            </label>
          </div>
        </div>
        <div class="field has-text-centered">
          <button type="submit" class="button is-primary" :disabled="file==''">Enviar</button>
        </div>
      </form>
    </template>
  </modal>
</template>

<script>
import Modal from "../utils/Modal.vue";
export default {
  components: { Modal },
  data() {
    return {
      modalActive: false,
      currentOva: "",
      file: "",
      defaultError: "",
      showError: false
    };
  },
  created() {
    /** Listening when a detail needs to be showed  */
    OvaEmitter.$on("image", ova => {
      this.modalActive = !this.modalActive;
      this.currentOva = ova;
    });
  },
  methods: {
    uploadImage() {
      let formData = new FormData()
      formData.append('file',this.file, this.file.name)

      axios.post(`/app/ovas/images/${this.currentOva.id}`, formData, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
      }).then(response => {
          this.modalActive = false
          this.defaultError = ""
          this.showError = false
          this.file = ""
          this.$emit('success', response.data.message)
      }).catch(error => {
          this.defaultError = 'Ha ocurrido un error, asegúrese de que esté subiendo un archivo válido.'
          this.showError = true
      })

    },
    onChangeImageUpload(event) {
      this.file = this.$refs.file.files[0];
      this.setPreview(event)
    },
    setPreview(event) {
        if (this.file) {
          let reader = new FileReader()
          reader.addEventListener('load', (event) => {
            let preview = document.getElementById('preview')
            let image = document.createElement('img')
            image.src = reader.result
            preview.innerHTML = ''
            preview.appendChild(image)
          })
              
          reader.readAsDataURL(event.target.files[0])
         
        }
    }
  }
};
</script>
<style scoped>
.file {
  justify-content: center;
}
#preview {
  width: 96px;
  margin: 0 auto;
}
</style>
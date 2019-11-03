<template>
  <div>
    <small class="help has-text-centered">Evaluación</small>
    <div class="field">
      <div class="control">
        <input type="hidden" v-model="homework.id" />
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Actividad</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              class="input is-small"
              v-model="homework.content"
              type="text"
              placeholder="Contenido"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Entregable</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <div class="select is-primary is-small">
              <select v-model="homework.presentation">
                <option
                  v-for="(presentation, index) in presentations"
                  :key="index"
                  :value="presentation"
                >{{presentation}}</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="control has-text-centered">
      <button
        type="button"
        class="button is-small is-primary"
        :disabled="formActionable"
        @click="addHomework(homework)"
      >+</button>
    </div>

    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Actividades actuales</label>
      </div>
      <div class="field-body">
        <div class="field is-size-7">
          <ul v-if="homeworks.length">
            <li v-for="homework in homeworks" :key="homework.content">
              <p>
                {{homework.content}}
                <a href="#" @click.prevent="deleteHomework(homework)">
                  <i class="fa fa-minus-circle has-text-danger is-size-5"></i>
                </a>
              </p>
            </li>
          </ul>
          <p class="is-size-7" v-else>Actualmente no se han agregado actividades</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { presentations } from "./presentations";
export default {
  data() {
    return {
      homework: {
        id: "",
        link: false,
        content: "",
        presentation: ""
      },
      homeworks: [],
      presentations: []
    };
  },
  created() {
    this.presentations = presentations;
    this.homework.presentation = this.presentations[0];
  },
  methods: {
    addHomework(homework) {
      const content = homework.content;
      const presentation = homework.presentation;
      if (this.$parent.learningSection.id) {
        const homework = {
          learning_section_id: this.$parent.learningSection.id,
          content,
          presentation
        };
        axios.post("/homeworks", homework).then(response => {
          this.homeworks.push(response.data.homework);
        });
      } else {
        this.homeworks.push({ content, presentation });
      }
      this.$emit("homeworks", this.homeworks);
      this.resetForm();
    },
    deleteHomework(homework) {
      if (this.$parent.learningSection.id) {
        const tempHomework = homework;
        axios.delete(`/homeworks/${tempHomework.id}`).then(response => {
          console.log(response.data.message);
        });
      }
      let index = this.homeworks.indexOf(homework);
      this.homeworks.splice(index, 1);
      this.$emit("homeworks", this.homeworks);
    },
    resetForm() {
      for (let property in this.homework) {
        if (property === "presentation") {
          this.homework[property] = this.presentations[0];
        } else {
          this.homework[property] = "";
        }
      }
    }
  },
  computed: {
    formActionable() {
      return (
        this.homework.content.length < 3 ||
        this.homework.presentation.length < 3
      );
    }
  }
};
</script>
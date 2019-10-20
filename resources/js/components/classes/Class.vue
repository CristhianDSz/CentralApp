<template>
  <tr role="row" class="odd">
    <td class="sorting_1">{{index}}</td>
    <td v-if="!showClassInput">{{schoolClass.name}}</td>
    <td v-else>
      <input type="text" class="input" v-model="schoolClass.name" />
    </td>
    <td v-if="!showClassInput">{{schoolClass.grade.name}}</td>
    <td v-else>
      <div class="control">
        <div class="select">
          <select v-model="schoolClass.grade_id">
            <option v-for="grade in grades" :key="grade.id" :value="grade.id">{{grade.name}}</option>
          </select>
        </div>
      </div>
    </td>
    <td class="has-text-centered">
      <div class="field is-grouped action">
        <p class="control">
          <a
            href="#"
            class="button is-rounded is-text"
            v-if="showEditButton"
            @click.prevent="changeStates"
          >
            <span class="icon">
              <i class="fa fa-edit"></i>
            </span>
          </a>
          <a href="#" class="button is-rounded is-text" v-else @click.prevent="putClass">
            <span class="icon">
              <i class="fa fa-check"></i>
            </span>
          </a>
        </p>
        <p class="control">
          <a
            href="#"
            class="button is-rounded is-text action-delete"
            v-if="showEditButton"
            @click.prevent="deleteClass"
          >
            <span class="icon">
              <i class="fa fa-trash"></i>
            </span>
          </a>
          <a
            class="button is-rounded is-text action-delete"
            v-else
            @click.prevent="changeStates(false)"
          >
            <span class="icon">
              <i class="fa fa-times"></i>
            </span>
          </a>
        </p>
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["schoolClass", "index", "grades"],
  data() {
    return {
      showEditButton: true,
      showClassInput: false,
      initial: ""
    };
  },
  created() {
    this.initial = Object.assign({}, this.schoolClass);
  },
  methods: {
    changeStates(itWasEdited = true) {
      if (!itWasEdited) {
        this.schoolClass.name = this.initial.name;
        this.schoolClass.grade_id = this.initial.grade_id;
      }
      this.showEditButton = !this.showEditButton;
      this.showClassInput = !this.showClassInput;
    },
    putClass() {
      axios.put(`/classes/${this.schoolClass.id}`, this.schoolClass).then(response => {
        //console.log(response.data.message)
        this.initial = Object.assign({}, this.schoolClass);
        this.changeStates();
        this.$emit("success");
      });
    },
    deleteClass() {
      axios
        .delete(`/classes/${this.schoolClass.id}`, this.schoolClass)
        .then(response => {
          console.log(response.data.message);
          this.$emit("success");
        });
    }
  }
};
</script>
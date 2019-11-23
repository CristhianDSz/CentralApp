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
        <p class="control" v-if="$can('update classes')">
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
        <a class="button is-rounded is-text has-background-grey-light" v-else>
          <span class="icon">
            <i class="fa fa-edit has-text-white"></i>
          </span>
        </a>
        <p class="control" v-if="$can('delete classes')">
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
        <a class="button is-rounded is-text has-background-grey-light" v-else>
          <span class="icon">
            <i class="fa fa-trash has-text-white"></i>
          </span>
        </a>
      </div>
    </td>
  </tr>
</template>

<script>
import { permissionsMixin } from "../../mixins/PermissionsMixin";
export default {
  props: ["schoolClass", "index", "grades"],
  mixins: [permissionsMixin],
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
      axios
        .put(`/classes/${this.schoolClass.id}`, this.schoolClass)
        .then(response => {
          //console.log(response.data.message)
          this.initial = Object.assign({}, this.schoolClass);
          this.changeStates();
          this.$emit("success");
        });
    },
    deleteClass() {
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
        })
        .then(result => {
          if (result.value) {
            axios
              .delete(`/classes/${this.schoolClass.id}`, this.schoolClass)
              .then(response => {
                this.$swal.fire('Eliminado!', response.data.message, 'success')
                this.$emit("success");
              });
          }
        });
    }
  }
};
</script>
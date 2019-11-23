<template>
  <tr role="row" class="odd">
    <td class="sorting_1">{{index}}</td>
    <td v-if="!showGradeInput">{{grade.name}}</td>
    <td v-else>
      <input type="text" class="input" v-model="grade.name" />
    </td>
    <td class="has-text-centered">
      <div class="field is-grouped action">
        <p class="control" v-if="$can('update grades')">
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
          <a href="#" class="button is-rounded is-text" v-else @click.prevent="putGrade">
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
        <p class="control" v-if="$can('delete grades')">
          <a href="#" class="button is-rounded is-text action-delete" v-if="showEditButton" @click.prevent="deleteGrade">
            <span class="icon">
              <i class="fa fa-trash"></i>
            </span>
          </a>
          <a class="button is-rounded is-text action-delete" v-else @click.prevent="changeStates(false)">
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
import {permissionsMixin} from '../../mixins/PermissionsMixin'
export default {
  props: ['grade','index'],
  mixins:[permissionsMixin],
  data() {
    return {
      showEditButton: true,
      showGradeInput: false,
      initial: ''
    };
  },
  created() {
    this.initial = Object.assign({},this.grade)
  },
  methods: {
    changeStates(itWasEdited=true) {
      if (!itWasEdited) {
        this.grade = this.initial
      }
      this.showEditButton = !this.showEditButton;
      this.showGradeInput = !this.showGradeInput;
    },
    putGrade() {
      axios.put(`/grades/${this.grade.id}`, this.grade).then(response => {
          //console.log(response.data.message)
          this.initial = Object.assign({},this.grade)
          this.changeStates();
          this.$emit('success')
      })
    },
    deleteGrade() {
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
            axios.delete(`/grades/${this.grade.id}`, this.grade).then(response=>{
              this.$swal.fire('Eliminado!', response.data.message, 'success')
              this.$emit('success')
        })
          }
        })
        
    }
  }
};
</script>
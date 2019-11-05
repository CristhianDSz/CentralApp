<template>
  <tr role="row" class="odd">
    <td class="sorting_1">{{index}}</td>
    <td v-if="!showAreaInput">{{area.name}}</td>
    <td v-else>
      <input type="text" class="input" v-model="area.name" />
    </td>
    <td class="has-text-centered">
      <div class="field is-grouped action">
        <p class="control" v-if="$can('update mandatory_areas')">
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
          <a href="#" class="button is-rounded is-text" v-else @click.prevent="putArea">
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
        <p class="control" v-if="$can('delete mandatory_areas')">
          <a href="#" class="button is-rounded is-text action-delete" v-if="showEditButton" @click.prevent="deleteArea">
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
  props: ['area','index'],
  mixins:[permissionsMixin],
  data() {
    return {
      showEditButton: true,
      showAreaInput: false,
      initial: ''
    };
  },
  created() {
    this.initial = Object.assign({},this.area)
  },
  methods: {
    changeStates(itWasEdited=true) {
      if (!itWasEdited) {
        this.area = this.initial
      }
      this.showEditButton = !this.showEditButton;
      this.showAreaInput = !this.showAreaInput;
    },
    putArea() {
      axios.put(`/mandatory-areas/${this.area.id}`, this.area).then(response => {
          //console.log(response.data.message)
          this.initial = Object.assign({},this.area)
          this.changeStates();
          this.$emit('success')
      })
    },
    deleteArea() {
        axios.delete(`/mandatory-areas/${this.area.id}`, this.area).then(response=>{
          console.log(response.data.message)
          this.$emit('success')
        })
    }
  }
};
</script>
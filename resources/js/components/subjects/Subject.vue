<template>
  <tr role="row" class="odd">
    <td class="sorting_1">{{index}}</td>
    <td v-if="!showSubjectInput">{{subject.name}}</td>
    <td v-else>
      <input type="text" class="input" v-model="subject.name" />
    </td>
    <td v-if="!showSubjectInput">{{subject.mandatory_area.name}}</td>
    <td v-else>
      <div class="control">
        <div class="select">
          <select v-model="subject.mandatory_area_id">
            <option v-for="area in areas" :key="area.id" :value="area.id">{{area.name}}</option>
          </select>
        </div>
      </div>
    </td>
    <td class="has-text-centered">
      <div class="field is-grouped action">
        <p class="control" v-if="$can('update subjects')">
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
          <a href="#" class="button is-rounded is-text" v-else @click.prevent="putSubject">
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
        <p class="control" v-if="$can('delete subjects')">
          <a
            href="#"
            class="button is-rounded is-text action-delete"
            v-if="showEditButton"
            @click.prevent="deleteSubject"
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
import {permissionsMixin} from '../../mixins/PermissionsMixin'
export default {
  props: ["subject", "index", "areas"],
  mixins:[permissionsMixin],
  data() {
    return {
      showEditButton: true,
      showSubjectInput: false,
      initial: ""
    };
  },
  created() {
    this.initial = Object.assign({}, this.subject);
  },
  methods: {
    changeStates(itWasEdited = true) {
      if (!itWasEdited) {
        this.subject.name = this.initial.name;
        this.subject.mandatory_area_id = this.initial.mandatory_area_id;
      }
      this.showEditButton = !this.showEditButton;
      this.showSubjectInput = !this.showSubjectInput;
    },
    putSubject() {
      axios.put(`/subjects/${this.subject.id}`, this.subject).then(response => {
        //console.log(response.data.message)
        this.initial = Object.assign({}, this.subject);
        this.changeStates();
        this.$emit("success");
      });
    },
    deleteSubject() {
      axios
        .delete(`/subjects/${this.subject.id}`, this.subject)
        .then(response => {
          console.log(response.data.message);
          this.$emit("success");
        });
    }
  }
};
</script>
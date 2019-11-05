export const permissionsMixin = {
    data() {
      return {
        $permissions: []
      }
    },
    mounted() {
      this.$permissions = Permissions
    },
    methods: {
        $can(permissionName) {
          return Permissions.indexOf(permissionName) !== -1;
        }
    },
}

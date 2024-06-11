<template>
  <div class="flex flex-col space-y-3">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">Manage Users</h1>
      </div>
      <div>
        <button
          class="flex items-center p-2 transition-transform duration-300 transform cursor-pointer hover:scale-105 group text-gray-600"
          @click="goToAddUser"
        >
          <v-icon name="md-add-round"></v-icon>
          Add User
        </button>
      </div>
    </div>

    <div class="relative overflow-x-auto shadow-md rounded-lg p-4 bg-white">
      <table
        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
      >
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Email</th>
            <th scope="col" class="px-6 py-3">User Type</th>

            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="user in users"
            :key="user.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          >
            <td
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
            >
              {{ user.name }}
            </td>
            <td class="px-6 py-4">{{ user.email }}</td>
            <td class="px-6 py-4">{{ user.user_Type }}</td>

            <td class="px-6 py-4 space-x-3">
              <button
                class="font-medium text-blue-500 hover:underline"
                @click="goToEditUsers(user.id)"
              >
                Edit
              </button>
              <button
                @click="confirmDelete(user.id)"
                class="font-medium text-red-500 hover:underline"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "ManageUserComponent",

  data() {
    return {
      userToDeleteId: null,
    };
  },

  computed: {
    users() {
      return this.$store.state.users;
    },
  },

  methods: {
    goToAddUser() {
      this.$router.push("/admin/addUsers").then(() => {
        window.location.reload();
      });
    },

    goToEditUsers(userId) {
      this.$router
        .push({ name: "editUsers", params: { id: userId } })
        .then(() => {
          window.location.reload();
        });
    },

    confirmDelete(userId) {
      this.userToDeleteId = userId;
      const confirmed = window.confirm(
        "Are you sure you want to delete this user?"
      );
      if (confirmed) {
        this.deleteUser(userId);
      }
    },

    deleteUser(userId) {
      this.$store
        .dispatch("deleteUser", userId)
        .then(() => {
          this.userToDeleteId = null;
        })
        .catch((error) => {
          console.error("Error deleting user:", error);
        });
    },
  },

  mounted() {
    this.$store.dispatch("fetchUsers");
  },
};
</script>

<template>
  <div class="flex flex-col space-y-4">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">Edit this User</h1>
      </div>
      <div>
        <button
          class="flex items-center p-2 transition-transform duration-300 transform cursor-pointer hover:scale-105 group text-gray-600"
          @click="goToDoctors"
        >
          <v-icon name="md-arrowbackiosnew-round"></v-icon>
          Back
        </button>
      </div>
    </div>

    <div class="flex flex-col space-y-4 p-4 bg-white rounded-lg shadow-md">
      <div class="space-y-3">
        <div>
          <label
            for="name"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Name</label
          >
          <input
            type="text"
            id="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="John Doe"
            required
          />
        </div>

        <div>
          <label
            for="name"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Username</label
          >
          <input
            type="text"
            id="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="doctor@example.com"
            required
          />
        </div>

        <div>
          <label
            for="name"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Password</label
          >
          <input
            type="password"
            id="password"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="••••••••"
            required
          />
        </div>

        <div>
          <label
            for="countries"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >User Type</label
          >
          <select
            id="countries"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <option selected>Choose a user</option>
            <option value="Admin">Admin</option>
            <option value="Doctor">Doctor</option>
            <option value="Patient">Patient</option>
          </select>
        </div>
      </div>
    </div>

    <div class="flex justify-end">
      <button
        class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-500 font-medium rounded-lg p-2 text-center w-24"
      >
        Update
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: "EditUsers",

  methods: {
    goToDoctors() {
      this.$router.push("/admin/manageUsers").then(() => {
        window.location.reload();
      });
    },
  },
};
</script>

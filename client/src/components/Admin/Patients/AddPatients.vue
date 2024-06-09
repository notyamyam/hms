<template>
  <div class="space-y-3">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">Add Patient</h1>
      </div>
      <div>
        <button
          class="flex items-center p-2 transition-transform duration-300 transform cursor-pointer hover:scale-105 group text-gray-600"
          @click="goToPatients"
        >
          <v-icon name="md-arrowbackiosnew-round"></v-icon>
          Back
        </button>
      </div>
    </div>

    <div class="flex flex-col space-y-4 p-4 bg-white rounded-lg shadow-md">
      <div class="text-gray-700">
        <h1 class="font-medium">Patient's Profile</h1>
      </div>

      <div class="space-y-5">
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
            placeholder="Dr. John Doe"
            required
          />
        </div>

        <div>
          <label
            for="gender"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Gender</label
          >
          <select
            id="gender"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>

        <div>
          <label
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Age</label
          >
          <input
            type="number"
            id="age"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            required
          />
        </div>
      </div>
    </div>

    <div class="flex justify-end">
      <button
        class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-500 font-medium rounded-lg p-2 text-center w-24"
      >
        Save
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: "AddPatients",

  methods: {
    goToPatients() {
      this.$router.push("/admin/patients").then(() => {
        window.location.reload();
      });
    },
  },
};
</script>

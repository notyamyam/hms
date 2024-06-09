<template>
  <div class="space-y-2">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">Edit Medical Record</h1>
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
            for="date"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >When</label
          >

          <div class="relative max-w-sm">
            <div
              class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
            >
              <svg
                class="w-4 h-4 text-gray-500 dark:text-gray-400"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                />
              </svg>
            </div>
            <input
              datepicker
              datepicker-autohide
              datepicker-buttons
              datepicker-autoselect-today
              type="text"
              class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Select date"
            />
          </div>
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

        <div>
          <label
            for="message"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Remarks</label
          >
          <textarea
            id="message"
            rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder=""
          ></textarea>
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
  name: "EditPatients",

  methods: {
    goToPatients() {
      this.$router.push("/doctor/recordsD").then(() => {
        window.location.reload();
      });
    },
  },
};
</script>

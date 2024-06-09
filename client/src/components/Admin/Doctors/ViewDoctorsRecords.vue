<template>
  <div class="flex flex-col space-y-4">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">Doctor's Record</h1>
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

    <div class="relative overflow-x-auto shadow-md rounded-lg p-4 bg-white">
      <table
        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
      >
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">Patient's Name</th>
            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
            >
              Carlos Santiago
            </th>

            <td class="px-6 py-4 space-x-3"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "ViewDoctorsRecords",

  methods: {
    goToDoctors() {
      this.$router.push("/admin/doctors").then(() => {
        window.location.reload();
      });
    },
  },
};
</script>

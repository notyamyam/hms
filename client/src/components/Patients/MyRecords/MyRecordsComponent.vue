<template>
  <div class="space-y-3">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">My Records</h1>
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
            <th scope="col" class="px-6 py-3">Doctor</th>
            <th scope="col" class="px-6 py-3">When</th>
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
              Dr. Juan Ramirez
            </th>
            <td class="px-6 py-4 space-x-3">June 20, 2024</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {};
</script>

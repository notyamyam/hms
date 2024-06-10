<template>
  <div class="space-y-3">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">Medical Records</h1>
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
            <th scope="col" class="px-6 py-3">Patient Name</th>
            <th scope="col" class="px-6 py-3">Doctor Name</th>
            <th scope="col" class="px-6 py-3">When</th>
            <th scope="col" class="px-6 py-3">Description</th>
            <th scope="col" class="px-6 py-3">Remarks</th>
            <th scope="col" class="px-6 py-3">Payment Status</th>

          </tr>
        </thead>
        <tbody>
          <tr
            v-for="record in records"
            :key="record.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
            >
              {{ record.patient_name }}
            </th>
            <td class="px-6 py-4 space-x-3">{{ record.doctor_name }}</td>

            <td class="px-6 py-4 space-x-3">{{ record.appointment_date }}</td>
            <td class="px-6 py-4 space-x-3">{{ record.description }}</td>

            <td class="px-6 py-4 space-x-3">{{ record.findings }}</td>
            <td class="px-6 py-4 space-x-3">{{ record.payment_status }}</td>

           
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "RecordsComponentD",

  data() {
    return {
      records: []
    };
  },

  methods: {
    goToEditRecord(recordId) {
      this.$router.push(`/doctor/editRecordsD/${recordId}`).then(() => {
        window.location.reload();
      });
    },
    
    fetchRecords() {
      axios.get(`http://127.0.0.1:8000/api/getAdminRecord`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      })
      .then(response => {
        this.records = response.data;
      })
      .catch(error => {
        console.error(error);
      });
    },
  },

  mounted() {
    this.fetchRecords();
  }
};
</script>

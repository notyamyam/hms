<template>
  <div class="space-y-3">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">Edit Appointment</h1>
      </div>
      <div>
        <button
          class="flex items-center p-2 transition-transform duration-300 transform cursor-pointer hover:scale-105 group text-gray-600"
          @click="goToRecords"
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

      <div>
        <div class="mb-5">
          <label
            for="doctor"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Doctor</label
          >
          <input
            v-model="appointment.doctor"
            type="text"
            id="doctor"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="Dr. John Doe"
            required
          />
        </div>

        <div class="mb-5">
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
                aria-hidden="true"
                class="w-5 h-5 text-gray-500 dark:text-gray-400"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M6 2a1 1 0 0 0-1 1v1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1V3a1 1 0 1 0-2 0v1H7V3a1 1 0 0 0-1-1zm8 9a1 1 0 1 0-2 0 1 1 0 0 0 2 0zM7 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </div>
            <input
              v-model="appointment.date"
              datepicker
              type="datetime-local"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full pl-10 p-2.5"
              placeholder="Select date"
            />
          </div>
        </div>

        <div class="flex justify-end space-x-2">
          <button
            @click="submitAppointment"
            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
          >
            Save Changes
          </button>
          <button
            @click="goToRecords"
            class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 border border-gray-300 font-medium rounded-lg text-sm px-5 py-2.5"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  name: "EditAppointmentComponent",
  data() {
    return {
      appointment: {
        doctor: '',
        date: ''
      }
    };
  },
  methods: {
    fetchAppointment() {
      axios.get(`/api/appointments/${this.$route.params.id}`)
        .then(response => {
          this.appointment = response.data;
        })
        .catch(error => {
          console.error('Error fetching appointment:', error);
        });
    },
    submitAppointment() {
      axios.put(`/api/appointments/${this.$route.params.id}`, this.appointment)
        .then(() => {
          this.$router.push("/patient/appointments").then(() => {
            window.location.reload();
          });
        })
        .catch(error => {
          console.error('Error updating appointment:', error);
        });
    },
    goToRecords() {
      this.$router.push("/patient/appointments");
    }
  },
  mounted() {
    this.fetchAppointment();
  }
};
</script>

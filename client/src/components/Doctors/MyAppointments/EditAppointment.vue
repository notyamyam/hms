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
            for="name"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
          >Name</label>
          <input
            type="text"
            id="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            :value="appointment.patient_name"
            disabled
          />
        </div>

        <div class="mb-5">
          <label
            for="date"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
          >Date and Time</label>
          <input
            type="datetime-local" 
            id="date"
            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            v-model="appointment.appointment_date"
          />
        </div>

        

        <div class="mb-5">
          <label
            for="description"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
          >Description</label>
          <textarea
            id="description"
            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            :value="appointment.description"
            disabled
          ></textarea>
        </div>
      </div>
    </div>

    <div class="flex justify-end">
      <button
        class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-500 font-medium rounded-lg p-2 text-center w-24"
        @click="updateAppointment"
      >
        Update
      </button>
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  name: "EditAppointment",

  data() {
    return {
      appointment: {},
    };
  },

  methods: {
    goToRecords() {
      this.$router.push("/doctor/myappointments").then(() => {
        window.location.reload();
      });
    },

    fetchAppointment() {
      const token = localStorage.getItem("token");

      axios.get(`http://127.0.0.1:8000/api/appointmentCatch/${this.appointmentId}`, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  })
        .then(response => {
          this.appointment = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },

    updateAppointment() {
    const token = localStorage.getItem("token");

    axios.put(`http://127.0.0.1:8000/api/updateDate/${this.appointmentId}`, { appointment_date: this.appointment.appointment_date }, {
        headers: {
            Authorization: `Bearer ${token}`,
        },
    })
    .then(response => {
        console.log(response.data);
        this.appointment = response.data;

        this.$nextTick(() => {
            this.appointment.appointment_date = response.data.appointment_date;
        });
        this.$router.push("/doctor/myappointments").then(() => {
        window.location.reload();
      });
        
    })
    .catch(error => {
        console.error(error);
    });
}

  },

  mounted() {
    this.appointmentId = this.$route.params.appointmentId; 
    this.fetchAppointment();
  }
};
</script>

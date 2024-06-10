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
          <select
            v-model="selectedDoctorId"
            id="doctor"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            required
          >
            <option value="">Select Doctor</option>
            <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">{{ doctor.name }}</option>
          </select>
        </div>

        <div class="mb-5">
          <label
            for="description"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Description</label
          >
          <textarea
            v-model="appointment.description"
            id="description"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="Enter description"
            required
          ></textarea>
        </div>

        <div class="mb-5">
          <label
            for="date"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >When</label
          >
          <input
            v-model="appointment.appointment_date"
            type="datetime-local"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="Select date"
            required
          />
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
        doctor_id: '',
        description: '', 
        appointment_date: '',
      },
      doctors: [],
      selectedDoctorId: '',
      appointmentId: null
    };
  },
  methods: {
    fetchAppointment() {
      axios.get(`http://127.0.0.1:8000/api/appointmentCatch/${this.appointmentId}`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      })
        .then(response => {
          this.appointment = response.data;
          this.selectedDoctorId = this.appointment.doctor_id;
        })
        .catch(error => {
          console.error('Error fetching appointment:', error);
        });
    },
    fetchDoctors() {
      axios.get('http://127.0.0.1:8000/api/doctors')
        .then(response => {
          this.doctors = response.data;
        })
        .catch(error => {
          console.error('Error fetching doctors:', error);
        });
    },
    submitAppointment() {
      this.appointment.doctor_id = this.selectedDoctorId;
      axios.put(`http://127.0.0.1:8000/api/updatePatientAppointment/${this.appointmentId}`, this.appointment, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      })
      .then(() => {
        this.$router.push("/patient/appointmentsP").then(() => {
          window.location.reload();
        });
      })
      .catch(error => {
        console.error('Error updating appointment:', error);
      });
    },
    goToRecords() {
      this.$router.push("/patient/appointmentsP");
    }
  },
  mounted() {
    this.appointmentId = this.$route.params.id;
    this.fetchAppointment();
    this.fetchDoctors();
  }
};
</script>

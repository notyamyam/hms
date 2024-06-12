<template>
  <div class="space-y-3">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">All Appointments</h1>
      </div>
    </div>

    <div
      v-if="appointments.length === 0"
      class="mt-6 text-gray-600 text-center"
    >
      <p>No appointments available.</p>
    </div>

    <div
      v-else
      class="relative overflow-x-auto shadow-md rounded-lg p-4 bg-white"
    >
      <table
        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
      >
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">Doctor Name</th>
            <th scope="col" class="px-6 py-3">Patient Name</th>
            <th scope="col" class="px-6 py-3">Appointment Date</th>
            <th scope="col" class="px-6 py-3">Description</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="appointment in appointments"
            :key="appointment.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
            >
              {{ appointment.doctor_name }}
            </th>
            <td class="px-6 py-4 space-x-3">{{ appointment.patient_name }}</td>
            <td class="px-6 py-4 space-x-3">
              {{ appointment.appointment_date }}
            </td>
            <td class="px-6 py-4 space-x-3">{{ appointment.description }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "MyAppointmentsComponent",

  data() {
    return {
      appointments: [],
      appointmentToApprove: null,
    };
  },

  methods: {
    fetchAppointments() {
      axios
        .get(`http://127.0.0.1:8000/api/getAdminAppointments`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        })
        .then((response) => {
          this.appointments = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    approveAppointment(id) {
      const token = localStorage.getItem("token");

      axios
        .put(
          `http://127.0.0.1:8000/api/appointmentsApprove/${id}`,
          { appointment_id: id },
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        )
        .then(() => {
          this.fetchAppointments();
        })
        .catch((error) => {
          console.error(error);
        });
    },
    editAppointment(id) {
      this.$router.push(`/doctor/editAppointment/${id}`);
    },
    denyAppointment(id) {
      const token = localStorage.getItem("token");

      axios
        .put(
          `http://127.0.0.1:8000/api/denyAppointment/${id}`,
          { appointment_id: id },
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        )
        .then(() => {
          this.fetchAppointments();
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },

  mounted() {
    this.fetchAppointments();
  },
};
</script>

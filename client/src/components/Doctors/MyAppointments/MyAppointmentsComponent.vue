<template>
  <div class="space-y-3">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">My Appointments</h1>
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
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">When</th>
            <th scope="col" class="px-6 py-3">Gender</th>
            <th scope="col" class="px-6 py-3">Age</th>
            <th scope="col" class="px-6 py-3">Description</th>
            <th scope="col" class="px-6 py-3">Status</th>

            <th scope="col" class="px-6 py-3">Action</th>
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
              {{ appointment.name }}
            </th>
            <td class="px-6 py-4 space-x-3">{{ appointment.appointment_date }}</td>
            <td class="px-6 py-4 space-x-3">{{ appointment.Gender }}</td>
            <td class="px-6 py-4 space-x-3">{{ appointment.Age }}</td>
            <td class="px-6 py-4 space-x-3">{{ appointment.description }}</td>
            <td class="px-6 py-4 space-x-3">{{ appointment.status }}</td>


            <td class="px-6 py-4 space-x-3">
              <button
                class="font-medium text-blue-500 hover:underline"
                @click="editAppointment(appointment.id)"
              >
                Edit
              </button>

              <button
                class="font-medium text-blue-500 hover:underline"
                @click="approveAppointment(appointment.id)"
              >
                Approve
              </button>
              
              <button
                class="font-medium text-red-500 hover:underline"
                @click="denyAppointment(appointment.id)"
              >
                Deny
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "MyAppointmentsComponent",

  data() {
    return {
      appointments: [],
      appointmentToApprove: null
    };
  },

  methods: {
    fetchAppointments() {
      const doctorId = localStorage.getItem('userId');

      axios.get(`http://127.0.0.1:8000/api/showForDoctor/${doctorId}` , {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    })
        .then(response => {
          this.appointments = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
approveAppointment(id) {
  const token = localStorage.getItem("token");

  axios.put(`http://127.0.0.1:8000/api/appointmentsApprove/${id}`, { appointment_id: id }, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  })
  .then(() => {
    this.fetchAppointments();
  })
  .catch(error => {
    console.error(error);
  });
  
}, editAppointment(id) {
      this.$router.push(`/doctor/editAppointment/${id}`);
    },
    denyAppointment(id) {
      const token = localStorage.getItem("token");

      axios.put(`http://127.0.0.1:8000/api/denyAppointment/${id}`, { appointment_id: id }, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then(() => {
        this.fetchAppointments();
      })
      .catch(error => {
        console.error(error);
      });
    }
  },

  mounted() {
    this.fetchAppointments();
  }
};
</script>

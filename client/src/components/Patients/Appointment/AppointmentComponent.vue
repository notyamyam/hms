<template>
  <div class="">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">My Appointments</h1>
      </div>

      <div>
        <button
          class="flex items-center p-2 transition-transform duration-300 transform cursor-pointer hover:scale-105 group text-gray-600"
          @click="goToBookAppointment"
        >
          <v-icon name="md-add-round"></v-icon>
          Book Appointment
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
            <th scope="col" class="px-6 py-3">Doctor</th>
            <th scope="col" class="px-6 py-3">When</th>
            <th scope="col" class="px-6 py-3">Description</th>

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
              {{ appointment.doctor.name }}
            </th>
            <td class="px-6 py-4 space-x-3">
              {{ appointment.appointment_date }}
            </td>
            <td class="px-6 py-4 space-x-3">{{ appointment.description }}</td>

            <td class="px-6 py-4 space-x-3">
              <button
                class="font-medium text-blue-500 hover:underline"
                @click="goToEditAppointment(appointment.id)"
              >
                Edit
              </button>

              <button
                class="font-medium text-red-500 hover:underline"
                @click="confirmCancel(appointment.id)"
              >
                Cancel
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL FOR CANCEL -->
  <div
    id="popup-modal"
    tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50"
  >
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button
          type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          @click="closeModal"
        >
          <svg
            class="w-3 h-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 14"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
            />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
          <svg
            class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 20 20"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
            />
          </svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
            Are you sure you want to cancel this appointment?
          </h3>
          <button
            @click="cancelAppointment"
            type="button"
            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
          >
            Yes, I'm sure
          </button>
          <button
            @click="closeModal"
            type="button"
            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
          >
            No, cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "AppointmentComponent",
  data() {
    return {
      appointments: [],
      appointmentToCancel: null,
    };
  },
  methods: {
    fetchAppointments() {
      const userId = localStorage.getItem("userId");

      axios
        .get(`http://127.0.0.1:8000/api/appointments?user_id=${userId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.appointments = response.data.filter(
            (appointment) => appointment.patient_id === parseInt(userId)
          );
          console.log("Filtered Appointments:", this.appointments);
        })
        .catch((error) => {
          console.error("Error fetching appointments:", error);
        });
    },
    goToBookAppointment() {
      this.$router.push("/patient/bookAppointmentP").then(() => {
        window.location.reload();
      });
    },
    goToEditAppointment(id) {
      this.$router.push(`/patient/editAppointmentP/${id}`).then(() => {
        window.location.reload();
      });
    },
    confirmCancel(id) {
      this.appointmentToCancel = id;
      document.getElementById("popup-modal").classList.remove("hidden");
    },
    closeModal() {
      document.getElementById("popup-modal").classList.add("hidden");
    },
    cancelAppointment() {
      axios
        .delete(
          `http://127.0.0.1:8000/api/appointments/${this.appointmentToCancel}`,
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
          }
        )
        .then(() => {
          this.fetchAppointments();
          this.closeModal();
        })
        .catch((error) => {
          console.error("Error cancelling appointment:", error);
        });
    },
  },

  mounted() {
    this.fetchAppointments();
  },
};
</script>

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
        <!-- Name -->
        <div>
          <label
            for="name"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Name</label
          >
          <input
            type="text"
            id="name"
            :value="record.name"
            disabled
            readonly
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
          />
        </div>

        <!-- When (Appointment Date) -->
        <div>
          <label
            for="date"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >When</label
          >
          <input
            type="datetime-local"
            id="date"
            :value="record.appointmentDate"
            disabled
            readonly
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block p-2.5"
          />
        </div>

        <!-- Gender -->
        <div>
          <label
            for="gender"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Gender</label
          >
          <input
            type="text"
            id="gender"
            :value="record.gender"
            readonly
            disabled
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          />
        </div>

        <!-- Age -->
        <div>
          <label
            for="age"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Age</label
          >
          <input
            type="number"
            id="age"
            :value="record.age"
            readonly
            disabled
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
          />
        </div>

        <!-- Age -->
        <div>
          <label
            for="age"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Description</label
          >
          <input
            type="text"
            id="description"
            :value="record.description"
            readonly
            disabled
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
          />
        </div>

        <!-- Remarks/ Findings -->
        <div>
          <label
            for="remarks"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Remarks</label
          >
          <textarea
            id="remarks"
            v-model="record.findings"
            rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          ></textarea>
        </div>

        <!-- Payment Status -->
        <div>
          <label
            for="paymentStatus"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Payment Status</label
          >
          <select
            id="paymentStatus"
            v-model="record.paymentStatus"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <option value="Pending">Pending</option>
            <option value="Paid">Paid</option>
          </select>
        </div>
      </div>
    </div>
    <div class="flex justify-end">
      <button
        @click="updateRecord"
        class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-500 font-medium rounded-lg p-2 text-center w-24"
      >
        Update
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "EditPatients",

  data() {
    return {
      recordId: null,
      record: {
        name: "",
        appointmentDate: "",
        gender: "",
        age: "",
        remarks: "",
        findings: "",
        paymentStatus: "",
        description: "",
      },
    };
  },

  methods: {
    goToPatients() {
      this.$router.push("/doctor/recordsD").then(() => {
        window.location.reload();
      });
    },

    updateRecord() {
      axios
        .put(
          `http://127.0.0.1:8000/api/updateRecord/${this.recordId}`,
          {
            findings: this.record.findings,
            payment_status: this.record.paymentStatus,
          },
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
          }
        )
        .then((response) => {
          console.log(response.data);
          this.$router.push(`/doctor/recordsD`);
        })
        .catch((error) => {
          console.error(error);
        });
    },

    fetchRecord() {
      axios
        .get(`http://127.0.0.1:8000/api/doctor/records/${this.recordId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        })
        .then((response) => {
          const { record } = response.data;
          this.record.name = record.appointment.patient.name;
          this.record.appointmentDate = record.appointment.appointment_date;
          this.record.gender = record.appointment.patient.gender;
          this.record.age = record.appointment.patient.age;
          this.record.findings = record.findings;
          this.record.paymentStatus = record.payment_status;
          this.record.description = record.appointment.description;
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },

  mounted() {
    this.recordId = this.$route.params.recordId;
    this.fetchRecord();
  },
};
</script>

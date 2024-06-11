<template>
  <div v-if="user.id" class="flex flex-col space-y-4">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">Edit this User</h1>
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

    <form
      @submit.prevent="updateUser"
      class="flex flex-col space-y-4 p-4 bg-white rounded-lg shadow-md"
    >
      <div class="space-y-3">
        <div>
          <label
            for="name"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Name</label
          >
          <input
            type="text"
            id="name"
            v-model="user.name"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="Enter Name"
            required
          />
        </div>

        <div>
          <label
            for="email"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Email</label
          >
          <input
            type="email"
            id="email"
            v-model="user.email"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="doctor@example.com"
            required
          />
        </div>

        <div>
          <label
            for="password"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Password</label
          >
          <input
            type="password"
            id="password"
            v-model="user.password"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="••••••••"
            required
          />
        </div>

        <div>
          <label
            for="confirm_password"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Confirm Password</label
          >
          <input
            type="password"
            id="confirm_password"
            v-model="user.confirm_password"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="••••••••"
            required
          />
        </div>

        <div>
          <label
            for="age"
            class="block mb-2 text-sm font-medium text-gray-600 dark:text-white"
            >Age</label
          >
          <input
            type="number"
            id="age"
            v-model="user.age"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
            placeholder="Enter age"
            required
          />
        </div>

        <div>
          <label
            for="gender"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Gender</label
          >
          <select
            id="gender"
            v-model="user.gender"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>

        <div>
          <label
            for="accountType"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >User Type</label
          >
          <select
            id="accountType"
            v-model="user.user_Type"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <option value="Admin">Admin</option>
            <option value="Doctor">Doctor</option>
            <option value="Patient">Patient</option>
          </select>
        </div>
      </div>

      <div class="flex justify-end">
        <button
          type="submit"
          class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-500 font-medium rounded-lg p-2 text-center w-24"
        >
          Update
        </button>
      </div>
    </form>
  </div>

  <div v-else>Loading</div>
</template>

<script>
import axios from "axios";

import { useToast } from "vue-toastification";

const toast = useToast();

export default {
  name: "EditUsers",

  data() {
    return {
      user: {
        id: "",
        name: "",
        email: "",
        password: "",
        confirm_password: "",
        age: "",
        gender: "",
        user_Type: "",
      },
    };
  },

  methods: {
    goToDoctors() {
      this.$router.push("/admin/manageUsers").then(() => {
        window.location.reload();
      });
    },

    fetchUserData() {
      const userId = this.$route.params.id;
      axios
        .get(`http://127.0.0.1:8000/api/users/${userId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        })
        .then((response) => {
          const userData = response.data.find(
            (user) => user.id === parseInt(userId)
          );
          if (userData) {
            this.user = userData;
            console.log(this.user);
          } else {
            console.error(`User with ID ${userId} not found.`);
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },

    updateUser() {
      const userId = this.$route.params.id;

      axios
        .put(`http://127.0.0.1:8000/api/users/${userId}`, this.user, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        })
        .then(() => {
          this.$router.push("/admin/manageUsers").then(() => {
            window.location.reload();
          });
        })
        .catch((error) => {
          const checkErrors = error.response?.data?.error ?? {};
          if (Object.keys(checkErrors).length > 0) {
            const errors = error.response.data.error;
            this.errors = {};
            let errorMessages = [];

            Object.keys(errors).forEach((field) => {
              this.errors[field] = errors[field];
              errorMessages = errorMessages.concat(errors[field]);
            });

            let formattedError = errorMessages.join("\n");

            if (errorMessages.length > 1) {
              formattedError = errorMessages
                .map((message) => `• ${message}`)
                .join("\n");
            }
            if (formattedError.length) {
              toast.error(formattedError, {
                timeout: 10000,
              });
            }

            console.error(error);
          } else {
            toast.error("An unexpected error occurred", {
              timeout: 3000,
            });
          }
        });
    },
  },

  mounted() {
    this.fetchUserData();
  },
};
</script>

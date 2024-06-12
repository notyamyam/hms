<template>
  <div class="flex flex-col space-y-4">
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">Add Patient</h1>
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

    <form
      @submit.prevent="save"
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
            v-model="name"
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
            v-model="email"
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
            v-model="password"
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
            v-model="confirm_password"
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
            v-model="age"
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
            v-model="gender"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
      </div>

      <div class="flex justify-end">
        <button
          type="submit"
          class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-500 font-medium rounded-lg p-2 text-center w-24"
        >
          Save
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";

import { useToast } from "vue-toastification";

const toast = useToast();

export default {
  name: "AddUsers",

  data() {
    return {
      name: "",
      email: "",
      password: "",
      confirm_password: "",
      age: "",
      gender: "",
      user_Type: "Patient",
      errors: {},
    };
  },

  methods: {
    save() {
      if (this.password !== this.confirm_password) {
        this.errors.confirm_password = [
          "The password confirmation does not match.",
        ];
        toast.error("The password confirmation does not match.");
        return;
      }

      // Reset errors
      this.errors = {};

      // Create user object
      const user = {
        name: this.name,
        email: this.email,
        password: this.password,
        confirm_password: this.confirm_password,
        age: this.age,
        gender: this.gender,
        user_Type: this.user_Type,
      };

      axios
        .post("http://127.0.0.1:8000/api/users", user, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        })
        .then((response) => {
          console.log(response.data);

          this.$router.push("/admin/patients").then(() => {
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

    goToPatients() {
      this.$router.push("/admin/patients").then(() => {
        window.location.reload();
      });
    },
  },
};
</script>

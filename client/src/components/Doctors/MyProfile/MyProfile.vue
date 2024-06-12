<template>
  <div>
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">My Profile</h1>
      </div>
    </div>

    <div
      class="mt-6 relative overflow-x-auto shadow-md rounded-lg p-4 bg-white"
    >
      <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input
          v-model="user.name"
          type="text"
          class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
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

      <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Age</label>
        <input
          v-model="user.age"
          type="number"
          class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring focus:ring-blue-500 block w-full p-2.5"
        />
      </div>

      <div class="mt-6">
        <button
          @click="updateProfile"
          class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
          Update
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "MyProfile",

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
    fetchUserProfile() {
      const userId = localStorage.getItem("userId");
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
            this.user.email = userData.email;
            this.user.name = userData.name;
            this.user.gender = userData.gender;
            this.user.age = userData.age;
            console.log(this.user);
          } else {
            console.error(`User with ID ${userId} not found.`);
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
    updateProfile() {
      const userId = localStorage.getItem("userId");
      const userProfile = {
        name: this.user.name,
        gender: this.user.gender,
        age: this.user.age,
      };

      axios
        .put(`http://127.0.0.1:8000/api/update/${userId}`, userProfile)
        .then(() => {
          this.$router.push("/doctor/myappointments").then(() => {
            window.location.reload();
          });
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
  mounted() {
    this.fetchUserProfile();
  },
};
</script>

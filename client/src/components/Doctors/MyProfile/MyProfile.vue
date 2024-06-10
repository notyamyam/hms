<template>
  <div>
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">My Profile</h1>
      </div>
    </div>

    <div class="mt-6">
      <div>
        <label class="block text-sm font-medium text-gray-700">
          Email
        </label>
        <input v-model="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
      </div>

      <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">
          Name
        </label>
        <input v-model="name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
      </div>

      <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">
          Gender
        </label>
        <input v-model="gender" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
      </div>

      <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">
          Age
        </label>
        <input v-model="age" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
      </div>

      <div class="mt-6">
        <button @click="updateProfile" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
          Update
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "MyProfile",

  data() {
    return {
      email: '',
      name: '',
      gender: '',
      age: 0
    };
  },

  methods: {
    fetchUserProfile() {
      const userId = localStorage.getItem("userId");
      axios.get(`http://127.0.0.1:8000/api/users/${userId}`)
        .then(response => {
          const userProfile = response.data;
          this.email = userProfile.email;
          this.name = userProfile.name;
          this.gender = userProfile.Gender;
          this.age = userProfile.Age;
        })
        .catch(error => {
          console.error(error);
        });
    },
    updateProfile() {
      const userId = localStorage.getItem("userId");
      const userProfile = {
        email: this.email,
        name: this.name,
        gender: this.gender,
        age: this.age
      };

      axios.put(`http://127.0.0.1:8000/api/update/${userId}`, userProfile)
        .then(response => {
          console.log('Profile updated successfully');
          this.appointment = response.data;
          window.location.reload();
        })
        .catch(error => {
          console.error(error);
        });
    }
  },

  mounted() {
    this.fetchUserProfile();
  }
};
</script>

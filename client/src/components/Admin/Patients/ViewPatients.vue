<template>
  <div>
    <div class="flex justify-between">
      <div>
        <h1 class="font-semibold text-xl text-gray-600">View Patient</h1>
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
  </div>
</template>
<script>
export default {
  name: "ViewPatients",

  methods: {
    goToPatients() {
      this.$router.push("/admin/patients").then(() => {
        window.location.reload();
      });
    },
  },
};
</script>

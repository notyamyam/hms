<template>
  <div class="space-y-0.5 h-screen overflow-hidden">
    <div
      class="p-5 bg-white font-medium shadow-md flex justify-between items-center"
    >
      <div>HMS (Doctor)</div>
      <div>
        <button
          id="dropdownHoverButton"
          data-dropdown-toggle="dropdownHover"
          data-dropdown-trigger="hover"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          type="button"
        >
          Hi, {{ name }}
          <svg
            class="w-2.5 h-2.5 ms-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 10 6"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m1 1 4 4 4-4"
            />
          </svg>
        </button>

        <div
          id="dropdownHover"
          class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44"
        >
          <ul
            class="py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100"
            aria-labelledby="dropdownHoverButton"
          >
            <li>
              <a @click="signOut" class="block px-4 py-2">Sign out</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="flex">
      <div
        class="'bg-white h-screen p-5 pt-7 duration-300 relative border-r border-gray-200 w-72"
      >
        <ul
          class="pt-2"
          v-for="(menu, index) in mappedMenus"
          :key="'menu-' + index"
        >
          <router-link :to="{ name: menu.routeName }">
            <li
              class="text-gray-600 text-lg flex items-center gap-x-4 cursor-pointer p-2 hover:bg-blue-500 hover:text-white rounded-lg"
            >
              <div class="flex items-center font-medium">
                <span class="flex items-center">
                  <v-icon
                    v-if="menu.icon"
                    :name="menu.icon"
                    scale="1.5"
                    class="text-regular block float-left"
                  />
                </span>
                <div class="flex">
                  <span
                    :class="[
                      'ms-4 text-base font-regular flex-1',
                      open
                        ? 'transition-all duration-300 ease-in-out'
                        : 'transition-none', // Apply transition only when open
                      open ? '' : 'opacity-0 translate-y-8', // Hide and move text when closed
                    ]"
                  >
                    {{ menu.title }}
                  </span>
                </div>
              </div>
            </li></router-link
          >
        </ul>
      </div>
      <div name="main" class="bg-gray-100 p-7 w-full">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "DoctorPage",

  data() {
    return {
      open: true,
      menus: [
        {
          title: "My Profile",
          icon: "md-personaddalt",
          routeName: "myprofile",
        },
      

        {
          title: "My Appointments",
          icon: "md-calendarmonth-outlined",
          routeName: "myappointments",
        },

        {
          title: "Records",
          icon: "md-librarybooks-outlined",
          routeName: "recordsD",
        },
      ],
      name: localStorage.getItem("name") || "Unknown",
    };
  },

  methods: {
    signOut() {
      localStorage.clear();
      this.$router.push("/");
    },
  },

  computed: {
    mappedMenus() {
      return this.menus;
    },
  },
};
</script>

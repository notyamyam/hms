import { createStore } from "vuex";
import axios from "axios";

export default createStore({
  state: {
    users: [],
  },

  mutations: {
    SET_USERS(state, users) {
      state.users = users;
    },
    DELETE_USER(state, userId) {
      state.users = state.users.filter((user) => user.id !== userId);
    },
  },

  actions: {
    fetchUsers({ commit }) {
      axios
        .get("http://127.0.0.1:8000/api/users", {
          headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
        })
        .then((response) => {
          commit("SET_USERS", response.data);
        })
        .catch((error) => {
          console.error(error);
        });
    },

    deleteUser({ commit }, userId) {
      axios
        .delete(`http://127.0.0.1:8000/api/delete_user/${userId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        })
        .then(() => {
          commit("DELETE_USER", userId);
        })
        .catch((error) => {
          console.error("Error deleting user:", error);
        });
    },
  },

  getters: {
    getUsers: (state) => state.users,
  },
});

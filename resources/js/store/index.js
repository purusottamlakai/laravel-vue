import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
  state: {
    isAuthenticated: !!localStorage.getItem('token'),
  },
  mutations: {
    SET_AUTH(state, isAuthenticated) {
      state.isAuthenticated = isAuthenticated;
    }
  },
  actions: {
    async checkAuthStatus({ commit }) {
      const token = localStorage.getItem('token');
      if (token) {
        try {
          await axios.get('/api/user');
          commit('SET_AUTH', true);
        } catch (error) {
          localStorage.removeItem('token');
          commit('SET_AUTH', false);
        }
      } else {
        commit('SET_AUTH', false);
      }
    },
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('/api/login', credentials);
        localStorage.setItem('token', response.data.token);
        commit('SET_AUTH', true);
      } catch (error) {
        commit('SET_AUTH', false);
        throw error;
      }
    },
    async logout({ commit }) {
      try {
        await axios.post('/api/logout');
        localStorage.removeItem('token');
        commit('SET_AUTH', false);
      } catch (error) {
        console.error("Error logging out:", error);
      }
    },
    removeToken({commit}){
        localStorage.removeItem('token');
        commit('SET_AUTH', false);
    }
  }
});

export default store;

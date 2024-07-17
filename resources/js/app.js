import '../css/app.css';
import { createApp } from 'vue';
import App from './Components/App.vue';
import router from './router/index.js';
import store from './store/index.js';
import axios from 'axios';

const app = createApp(App);

// Set default Authorization header if token exists in local storage
const token = localStorage.getItem('token');
if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

// Use Axios interceptors to always attach the token
axios.interceptors.request.use(
  config => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
  },
  error => {
    return Promise.reject(error);
  }
);

axios.interceptors.response.use(
  response => response,
  error => {
    if (error.response && error.response.status === 401) {
      store.dispatch('removeToken');
      router.push('/login');
    }
    return Promise.reject(error);
  }
);

app.use(router).use(store).mount('#app');

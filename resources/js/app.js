import '../css/app.css';
import { createApp } from  'vue';
import App from './Components/App.vue'
import router from './router/index.js';

const app = createApp(App);

app.use(router).mount('#app')



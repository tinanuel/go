import { createApp } from 'vue';
import App from './App.vue';
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import "bootstrap-icons/font/bootstrap-icons.css";
import axios from 'axios';
import VueAxios from 'vue-axios';

axios.defaults.baseURL = '/api';

createApp(App).use(VueAxios, axios).mount('#app');
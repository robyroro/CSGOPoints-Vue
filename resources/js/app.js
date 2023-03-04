require('./bootstrap');

import {createApp} from 'vue';
import VueApexCharts from 'vue3-apexcharts';
import App from './App.vue';
import axios from 'axios';
import router from './router';
import Toaster from "@meforma/vue-toaster";
import VueAwesomePaginate from "vue-awesome-paginate";

const app = createApp(App)
app.config.globalProperties.$axios = axios
app.use(router)
app.use(Toaster)
app.use(VueAwesomePaginate)
app.use(VueApexCharts)
app.mount('#app')
import './bootstrap';

import { createApp } from 'vue';
// Pages
import Dashboard from "./Pages/Dashboard.vue";
import Setting from "./Pages/Setting.vue";
import Order from "./Pages/Order.vue";
// End Pages

// External Components
import Toast from 'vue-toastification';
import "vue-toastification/dist/index.css";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
// End External Components

const app = createApp({});

app.use(Toast,{
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true,
    shareAppContext: true,
    containerClassName: 't-4em'
});
app.use(VueSweetalert2)

app.component('dashboard', Dashboard)
app.component('setting', Setting)
app.component('order', Order)

app.mount('#app');


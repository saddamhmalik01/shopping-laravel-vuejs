import './bootstrap';

import { createApp } from 'vue';
import app from '../components/app.vue';
import router from '../vue_routes/routes.js';
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import setAuthHeader from '../components/utils/setAuthHeader';
import { ObserveVisibility } from 'vue-observe-visibility';


let user = localStorage.getItem('user');
if (user) {
    setAuthHeader(user)
}
else {
    setAuthHeader(false)
}

createApp(app).directive('observe-visibility', ObserveVisibility).use(router).mount('#app')


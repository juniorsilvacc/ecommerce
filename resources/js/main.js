import { createApp } from 'vue';

import App from './App.vue';
import routes from './routes';
import store from './store';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle'

createApp(App)
    .use(routes)
    .use(store)
    .mount('#app');

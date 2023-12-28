import { createApp } from 'vue';

import AdminComponent from './components/admin/AdminComponent.vue';
import routes from './routes';
import store from './store';

createApp(AdminComponent)
    .use(routes)
    .use(store)
    .mount('#app');



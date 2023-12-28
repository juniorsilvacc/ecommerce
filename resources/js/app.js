import './bootstrap';

import { createApp } from 'vue';

// Components
import Home from './components/Home.vue';

const app = createApp();

app.component('app', Home)

app.mount('#app');

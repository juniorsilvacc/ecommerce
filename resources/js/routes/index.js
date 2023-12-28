import { createRouter, createWebHistory } from 'vue-router'

import DashboardComponent from '../components/admin/partials/dashboard/DashboardComponent.vue';
import CategoriesComponent from '../components/admin/partials/categories/CategoriesComponent.vue';

const routes = [
    {
        path: '/admin',
        component: DashboardComponent,
        name: 'dashboard',
    },
    {
        path: '/admin/categories',
        component: CategoriesComponent,
        name: 'categories',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

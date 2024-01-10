import { createRouter, createWebHistory } from 'vue-router'

import Admin from '../views/admin/Admin.vue';
import DashboardComponent from '../components/partials/dashboard/DashboardComponent.vue';
import CategoriesComponent from '../components/partials/categories/CategoriesComponent.vue';

const routes = [
    {
        path: '/',
        component: Admin,
    },
    {
        path: '/admin/dashboard',
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

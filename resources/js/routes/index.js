import { createRouter, createWebHistory } from 'vue-router'

import Admin from '../views/admin/Admin.vue';
import DashboardComponent from '../components/partials/dashboard/DashboardComponent.vue';
import CategoriesComponent from '../components/partials/categories/CategoriesComponent.vue';
import AddCategoryComponent from '../components/partials/categories/AddCategoryComponent.vue';

const routes = [
    {
        path: '/',
        component: Admin,
    },
    {
        path: '/admin/dashboard',
        component: DashboardComponent,
        name: 'admin.dashboard',
    },
    {
        path: '/admin/categories',
        component: CategoriesComponent,
        name: 'admin.categories',
    },
    {
        path: '/admin/categories/create',
        component: AddCategoryComponent,
        name: 'admin.categories.create',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

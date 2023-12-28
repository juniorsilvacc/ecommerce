import { createRouter, createWebHistory } from 'vue-router'

import AdminComponent from '../components/admin/AdminComponent.vue';
import DashboardComponent from '../components/admin/partials/dashboard/DashboardComponent.vue';
import CategoriesComponent from '../components/admin/partials/categories/CategoriesComponent.vue';

const routes = [
    {
        path: '/admin',
        component: AdminComponent,
        children: [
            {
                path: 'dashboard',
                component: DashboardComponent,
                name: 'dashboard',
            },
            {
                path: 'categorias',
                component: CategoriesComponent,
                name: 'categories',
            },
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

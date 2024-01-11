import { createRouter, createWebHistory } from 'vue-router'

import Admin from '../views/admin/Admin.vue';
import DashboardComponent from '../components/pages/dashboard/DashboardComponent.vue';
import CategoriesComponent from '../components/pages/categories/CategoriesComponent.vue';
import AddCategoryComponent from '../components/pages/categories/AddCategoryComponent.vue';
import EditCategoryComponent from '../components/pages/categories/EditCategoryComponent.vue';

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
    {
        path: '/admin/categories/:id/edit',
        component: EditCategoryComponent,
        name: 'admin.categories.edit',
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

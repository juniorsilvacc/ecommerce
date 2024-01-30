import { createRouter, createWebHistory } from 'vue-router'

// Site
import SiteComponent from '../components/SiteComponent.vue';
import SiteContactComponent from '../components/pages/contact/SiteContactComponent.vue';
import SiteHomeComponent from '../components/pages/home/SiteHomeComponent.vue';


// Dashboard
import DashboardComponent from '../components/pages/dashboard/DashboardComponent.vue';

// Categories
import CategoriesComponent from '../components/pages/categories/CategoriesComponent.vue';
import AddCategoryComponent from '../components/pages/categories/AddCategoryComponent.vue';
import EditCategoryComponent from '../components/pages/categories/EditCategoryComponent.vue';

// Products
import ProductsComponent from '../components/pages/products/ProductsComponent.vue';
import ProductDetailComponent from '../components/pages/products/ProductDetailComponent.vue';
import AddProductComponent from '../components/pages/products/AddProductComponent.vue';
import EditProductComponent from '../components/pages/products/EditProductComponent.vue';

const routes = [
    {
        path: '/',
        component: SiteComponent,
        children: [
            {
                path: '/home',
                component: SiteHomeComponent,
                name: 'home',

            },
            {
                path: '/contact',
                component: SiteContactComponent,
                name: 'contact',

            },
        ],
        meta: {
            showHeader: false,
        },
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
    {
        path: '/admin/categories/:id/delete',
        name: 'admin.categories.delete',
        props: true,
    },

    {
        path: '/admin/products',
        component: ProductsComponent,
        name: 'admin.products',
    },
    {
        path: '/admin/products/create',
        component: AddProductComponent,
        name: 'admin.product.create',
    },
    {
        path: '/admin/products/:id/details',
        component: ProductDetailComponent,
        name: 'admin.product.datail',
        props: true,
    },
    {
        path: '/admin/products/:id/edit',
        component: EditProductComponent,
        name: 'admin.products.edit',
        props: true,
    },
    {
        path: '/admin/categories/:id/delete',
        name: 'admin.products.delete',
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

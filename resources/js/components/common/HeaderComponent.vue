<template>
    <div>
        <ul class="nav bg-dark">
            <li class="nav-item">
                <router-link :to="{ name: 'admin.dashboard' }" class="nav-link"
                    >Dashboard</router-link
                >
            </li>
            <li>
                <router-link :to="{ name: 'admin.categories' }" class="nav-link"
                    >Categorias ({{ totalCategories }})</router-link
                >
            </li>
            <li>
                <router-link :to="{ name: 'admin.products' }" class="nav-link"
                    >Produtos ({{ totalProducts }})</router-link
                >
            </li>
        </ul>

        <router-view></router-view>
    </div>
</template>

<script>
export default {
    computed: {
        totalCategories() {
            const categories = this.$store.state.categories.items.data;
            return categories ? categories.length : 0;
        },
        totalProducts() {
            const products = this.$store.state.products.items.data;
            return products ? products.length : 0;
        },
    },
};
</script>

<style></style>

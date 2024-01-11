<template>
    <div>
        <ul class="nav bg-dark">
            <li class="nav-item">
                <router-link :to="'/admin/dashboard'" class="nav-link">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="'/admin/categories'" class="nav-link">Categorias ({{totalCategories}})</router-link>
            </li>
        </ul>

        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        computed: {
            totalCategories () {
                return this.$store.state.categories.items.data.length;
            }
        }
    }
</script>

<style>

</style>

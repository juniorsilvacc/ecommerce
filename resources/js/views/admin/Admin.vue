<template>
    <div>
        <ul>
            <li>
                <router-link :to="'/admin/dashboard'">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="'/admin/categories'">Categorias ({{totalCategories}})</router-link>
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

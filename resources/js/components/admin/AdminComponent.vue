<template>
    <div>
        <ul>
            <li>
                <router-link :to="'/admin'">Dashboard</router-link>
            </li>
            <li>
                <router-link :to="'/admin/categories'">Categorias</router-link>
            </li>
        </ul>

        <router-view></router-view>
    </div>
</template>

<script>
    export default {

    }
</script>

<style>

</style>

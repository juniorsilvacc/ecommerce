<template>
    <div class="container">
        <h1>Listagem de Categorias</h1>

        <router-link :to="{name: 'admin.categories.create'}" class="btn btn-success">Cadastrar</router-link>

        <table class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th width="100">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(category, index) in categories.data" :key="index">
                    <td>{{  category.id }}</td>
                    <td>{{  category.name }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        created () {
            this.$store.dispatch('loadCategories')
        },
        computed: {
            categories () {
                return this.$store.state.categories.items;
            }
        }
    }
</script>

<style scoped>

</style>

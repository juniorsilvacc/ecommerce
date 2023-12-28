<template>
    <div>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th width="100">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr :v-for="(category, index) in categories.data" :key="index">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td>{{ category.id }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        created () {
            this.loadCategories()
        },
        data () {
            return {
                categories: {
                    data: []
                },
            }
        },
        methods: {
            loadCategories () {
                axios.get("/api/v1/categories")
                    .then(response => {
                        this.categories = response
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            }
        }
    }
</script>

<style scoped>

</style>

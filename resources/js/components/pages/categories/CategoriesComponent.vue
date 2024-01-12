<template>
    <div class="container">
        <h1>Listagem de Categorias</h1>

        <router-link
            :to="{ name: 'admin.categories.create' }"
            class="btn btn-success"
            >Cadastrar</router-link
        >

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
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td class="acctions">
                        <router-link
                            :to="{
                                name: 'admin.categories.edit',
                                params: { id: category.id },
                            }"
                            class="btn btn-warning edit"
                            ><i class="fas fa-edit"></i
                        ></router-link>
                        <a
                            href=""
                            class="btn btn-danger"
                            @click.prevent="destroy(category)"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { notify } from "@kyvg/vue3-notification";

export default {
    created() {
        this.$store.dispatch("loadCategories");
    },
    computed: {
        categories() {
            return this.$store.state.categories.items;
        },
    },
    methods: {
        destroy(category) {
            this.$store
                .dispatch("destroyCategory", category.id)
                .then(() => {
                    notify({ title: `Sucesso ao deletar a categoria ${category.name}`, type: "success" });
                })
                .catch(error => {
                    notify({ title: "Error ao deletar categoria", type: "error" });
                });
        },
    },
};
</script>

<style scoped>
.acctions {
    display: flex;
}
.edit {
    margin-right: 10px;
}
</style>

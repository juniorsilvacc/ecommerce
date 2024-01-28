<template>
    <div class="container">
        <h1>Listagem de Categorias</h1>

        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <SearchCategoryComponent @searchCategory="search" />

                    <router-link
                        :to="{ name: 'admin.categories.create' }"
                        class="btn btn-success btn-custom"
                    >
                        Cadastrar
                    </router-link>
                </div>
            </div>
        </div>

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
                            class="btn btn-warning primary-btn-acction"
                            ><i class="fas fa-edit"></i
                        ></router-link>
                        <a
                            href=""
                            class="btn btn-danger"
                            @click.prevent="confirmDestroy(category)"
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
import SearchCategoryComponent from "./partials/SearchCategoryComponent.vue";

export default {
    components: {
        SearchCategoryComponent,
    },
    data() {
        return {
            name: "",
        };
    },
    created() {
        this.$store.dispatch("loadCategories", { name: this.name });
    },
    computed: {
        categories() {
            return this.$store.state.categories.items;
        },
    },
    methods: {
        confirmDestroy(category) {
            if (
                window.confirm(
                    `Tem certeza de que deseja excluir a categoria: ${category.name}?`
                )
            ) {
                this.destroy(category);
            }
        },

        destroy(category) {
            this.$store
                .dispatch("destroyCategory", category.id)
                .then(() => {
                    notify({
                        title: `Sucesso ao deletar a categoria: ${category.name}`,
                        type: "success",
                    });
                })
                .catch((error) => {
                    notify({
                        title: "Error ao deletar categoria",
                        type: "error",
                    });
                });
        },

        search(filter) {
            this.$store.dispatch("loadCategories", { name: filter });
        },
    },
};
</script>

<style scoped>
</style>

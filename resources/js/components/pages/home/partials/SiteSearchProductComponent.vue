<template>
    <div>
        <form
            class="form form-inline input-group mb-3"
            @submit.prevent="search"
        >
            <div class="form-group mr-2">
                <select
                    v-model="product.category_id"
                    class="form-control"
                    id="category_id"
                    name="category_id"
                >
                    <option value="">Selecione a categoria</option>
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
            </div>

            <div class="form-group mr-2">
                <input
                    type="text"
                    v-model="filter"
                    class="form-control"
                    placeholder="Pesquisar..."
                />
            </div>

            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            categories: [],
            product: {
                category_id: "",
            },
            filter: "",
        };
    },
    beforeMount() {
        this.loadCategories();
    },
    methods: {
        async loadCategories() {
            const response = await axios.get("/api/v1/categories");
            this.categories = response.data.data;
        },
        search() {
            if (this.product.category_id === "") {
                // Se estiver vazia, define category_id como null para incluir todos os produtos
                this.$emit("searchProduct", {
                    filter: this.filter,
                    category_id: null,
                });
            } else {
                // Se a categoria estiver selecionada, envia a busca normalmente
                this.$emit("searchProduct", {
                    filter: this.filter,
                    category_id: this.product.category_id,
                });
            }
        },
    },
};
</script>

<style scoped>
.form-control:focus,
.form-control:active {
    outline: none;
    box-shadow: none;
}
</style>

<template>
    <div class="container">
        <div>
            <h1>Adicionar Novo Produto</h1>
        </div>

        <FormProductComponent :product="product" :categories="categories" />
    </div>
</template>

<script>
import FormProductComponent from "./partials/FormProductComponent.vue";

export default {
    components: {
        FormProductComponent,
    },
    data() { // Inicialização do object product
        return {
            product: {
                name: "",
                description: "",
                category_id: null,
                price: null,
                image: new FormData()
            },
            categories: []
        };
    }
};
</script>

<style scoped>
</style>

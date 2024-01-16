<template>
    <div class="container">
        <div>
            <h1>Adicionar Novo Produto</h1>
        </div>

        <FormProductComponent :product="product"/>
    </div>
</template>

<script>
import FormProductComponent from "./partials/FormProductComponent.vue";

export default {
    components: {
        FormProductComponent,
    },
    data() {
        return {
            product: {
                name: "",
                description: "",
            },
        };
    }
};
</script>

<style scoped>
</style>

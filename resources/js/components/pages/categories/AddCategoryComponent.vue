<template>
    <div class="container">
        <div>
            <h1>Adicionar nova categoria</h1>
        </div>

        <FormCategoryComponent :category="category"/>
    </div>
</template>

<script>
import FormCategoryComponent from "./partials/FormCategoryComponent.vue";

export default {
    components: {
        FormCategoryComponent,
    },
    data() {
        return {
            category: {
                name: "",
                description: "",
            },
        };
    }
};
</script>

<style scoped></style>

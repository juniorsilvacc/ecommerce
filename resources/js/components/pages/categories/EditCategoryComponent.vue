<template>
    <div class="container">
        <h1>Editar Categoria</h1>

        <FormCategoryComponent
            :category="category.data"
            :updating="true"
        />
    </div>
</template>

<script>
import { useStore } from "vuex";
import FormCategoryComponent from "./partials/FormCategoryComponent.vue";

export default {
    props: {
        id: {
            required: true,
        },
    },
    components: {
        FormCategoryComponent,
    },
    data () {
        return {
            category: {
                data: {
                    name: "",
                    description: "",
                },
            }
        }
    },
    created () {
        const store = useStore();

        store.dispatch("loadCategory", this.id)
            .then((response) => {
                this.category = response;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>

<style scoped></style>

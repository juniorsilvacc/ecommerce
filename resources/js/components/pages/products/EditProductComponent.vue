<template>
    <div class="container">
        <h1>Editar Produto</h1>

        <FormProductComponent :product="product.data" :updating="true" />
    </div>
</template>

<script>
import { useStore } from "vuex";
import FormProductComponent from "./partials/FormProductComponent.vue";

export default {
    props: {
        id: {
            required: true,
        },
    },
    components: {
        FormProductComponent,
    },
    data() {
        return {
            product: {
                data: {
                    name: "",
                    price: null,
                    description: "",
                    category_id: "",
                    image: null,
                },
            },
        };
    },
    created() {
        const store = useStore();

        store
            .dispatch("loadProduct", this.id)
            .then((response) => {
                response.data.price = parseFloat(
                    response.data.price.replace("R$", "").replace(",", "")
                );

                this.product.data = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>

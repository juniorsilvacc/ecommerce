<template>
    <div class="container product-details">
        <div class="row">
            <div class="col-md-6 img">
                <img
                    :src="productImage"
                    alt="Product Image"
                    class="img-fluid"
                />
            </div>
            <div class="col-md-5 details">
                <h1>Detalhes de Produto</h1>
                <div><strong>Nome:</strong> {{ product.data.name }}</div>
                <div><strong>Preço:</strong> {{ product.data.price }}</div>
                <div><strong>Categoria:</strong> {{ product.data.category.name }}</div>
                <div><strong>Descrição:</strong> {{ product.data.description }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import { useStore } from "vuex";

export default {
    props: {
        id: {
            required: true,
        },
    },
    computed: {
        productImage() {
            return this.product.data.image
                ? `/storage/products/${this.product.data.image}`
                : "/img/default.jpg";
        },
    },
    data() {
        return {
            product: {
                data: {
                    name: "",
                    price: "",
                    description: "",
                    image: "",
                    category: "",
                },
            },
        };
    },
    created() {
        const store = useStore();

        store
            .dispatch("loadProduct", this.id)
            .then((response) => {
                this.product = response;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>

<style scoped>
.product-details {
    margin-top: 20px;
}

.img {
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 100px;
    padding: 10px;
    margin: 0 auto;
}

.product-details img {
    max-width: 300px;
    max-height: 280px;
    height: auto;
}
</style>

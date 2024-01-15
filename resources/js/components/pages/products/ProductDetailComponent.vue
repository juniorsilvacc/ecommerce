<template>
    <div class="container">
        <h1 class="my-4">Detalhes do Produto</h1>

        <div class="row">
            <div class="col-md-8">
                <ul class="list-group">
                <li class="list-group-item"><strong>Nome:</strong> {{ product.data.name }}</li>
                <li class="list-group-item"><strong>Descrição:</strong> {{ product.data.description }}</li>
                <li class="list-group-item"><strong>Preço:</strong> {{ product.data.price }}</li>
                <li class="list-group-item"><strong>Categoria:</strong> {{ product.data.category.name }}</li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="product-image-container">
                    <img :src="productImage" alt="Imagem do Produto" class="img-fluid product-image" />
                </div>
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
            return this.product.data.image ? `/storage/products/${this.product.data.image}` : '/img/default.jpg';
        }
    },
    data () {
        return {
            product: {
                data: {
                    name: "",
                    description: "",
                    image: "",
                    price: "",
                    category: ""
                },
            }
        }
    },
    created () {
        const store = useStore();

        store.dispatch("loadProduct", this.id)
            .then((response) => {
                this.product = response;
            })
            .catch((error) => {
                console.log(error);
            });
    },
}
</script>

<style scoped>
.product-image-container {
  width: 250px;
  margin: 0 auto;
  border: 1px solid #c7c3c3;
}

.product-image {
  width: 100%;
  height: auto;
}

.list-group-item:first-child {
  font-size: 1.2em;
}

.col-md-6:last-child {
  margin-top: 20px;
}
</style>

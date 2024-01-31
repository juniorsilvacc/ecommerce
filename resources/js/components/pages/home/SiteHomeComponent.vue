<template>
    <div class="container">
        <h1 class="mt-5 mb-4 title">Produtos</h1>

        <div class="row">
            <router-link
                :to="{
                    name: 'site.product.detail',
                    params: { id: product.id },
                }"
                v-for="product in products.data"
                :key="product.id"
                class="col-md-4 mb-4"
            >
                <div class="card">
                    <div class="card-img-container">
                        <img
                            :src="getImageUrl(product.image)"
                            :alt="`Imagem de ${product.name}`"
                            class="card-img-top img-product"
                        />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title custom-title">
                            {{ product.name }}
                        </h5>
                        <p class="card-text custom-price">
                            {{ product.price }}
                        </p>
                    </div>
                </div>
            </router-link>
        </div>

        <!-- Paginação -->
        <PaginationComponent
            v-if="products && products.meta"
            :currentPage="currentPage"
            :lastPage="products.meta.last_page"
            :changePage="paginate"
        />
    </div>
</template>

<script>
import PaginationComponent from "../../common/PaginationComponent.vue";

export default {
    components: {
        PaginationComponent,
    },
    data() {
        return {
            currentPage: 1,
        };
    },
    created() {
        if (this.products.data.length === 0) {
            this.$store.dispatch("loadProducts", {});
        }
    },
    computed: {
        products() {
            return this.$store.state.products.items;
        },
    },
    methods: {
        getImageUrl(image) {
            return image
                ? `/storage/products/${image}`
                : "/public/img/default.jpg";
        },
        paginate(page) {
            this.currentPage = page;
            this.$store.dispatch("loadProducts", { name: this.name, page });
        },
    },
};
</script>

<style scoped>
.title {
    text-align: center;
    margin-bottom: 50px !important;
}

.img-product {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.card {
    transition: transform 0.3s;
    width: 18rem;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    margin: 0 auto;
    text-align: center;
}

.card-body {
    display: flex;
    flex-direction: column;
}

.card-img-container {
    height: 200px;
    overflow: hidden;
}

.custom-title {
    margin-top: 10px;
    font-size: 1.25rem;
    font-weight: bold;
    color: #333;
}

.custom-price {
    color: #e44d26;
}

.card:hover {
    transform: scale(1.05);
}
</style>

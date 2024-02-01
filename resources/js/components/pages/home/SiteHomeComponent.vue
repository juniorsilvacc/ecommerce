<template>
    <div class="container">
        <h1 class="mt-5 mb-4 title">Produtos</h1>

        <div class="col-8">
            <SearchProductComponent @searchProduct="search" />
        </div>

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
        <div class="col-md-6 mb-4">
            <div class="paginate">
                <PaginationComponent
                    v-if="products && products.meta"
                    :currentPage="currentPage"
                    :lastPage="products.meta.last_page"
                    :changePage="paginate"
                />
            </div>
        </div>
    </div>
</template>

<script>
import SearchProductComponent from "../../pages/home/partials/SiteSearchProductComponent.vue";
import PaginationComponent from "../../common/PaginationComponent.vue";

export default {
    components: {
        SearchProductComponent,
        PaginationComponent,
    },
    data() {
        return {
            name: "",
            currentPage: 1,
        };
    },
    created() {
        if (this.products.data.length === 0) {
            this.$store.dispatch("loadProducts", { name: this.name });
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
        search({ filter, category_id }) {
            this.$store.dispatch("loadProducts", {
                name: filter,
                category_id,
                page: 1,
            });
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
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 20px;
    overflow: hidden;
    transition: transform 0.3s;
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

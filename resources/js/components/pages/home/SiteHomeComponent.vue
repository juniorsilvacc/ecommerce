<template>
    <div>
        <div class="container">
            <h1>Produtos</h1>

            <div class="row">
                <div
                    class="col-3"
                    v-for="product in products.data"
                    :key="product.id"
                >
                    <td class="img-product">
                        <img
                            :src="getImageUrl(product.image)"
                            :alt="product.name"
                        />
                    </td>
                    {{ product.name }}
                    {{ product.price }}
                </div>
            </div>

            <!-- Paginação -->
        <PaginationComponent
            v-if="products && products.meta"
            :currentPage="currentPage"
            :lastPage="products.meta.last_page"
            :changePage="paginate"
        />
        </div>
    </div>
</template>

<script>
import PaginationComponent from "../../common/PaginationComponent.vue";

export default {
    components: {
        PaginationComponent
    },
    data() {
        return {
            currentPage: 1,
        };
    },
    // O hook "created" é chamado quando o componente é criado
    created() {
        if (this.products.data.length == 0) {
            this.$store.dispatch("loadProducts", {});
        }
    },
    // A propriedade computada "products" retorna a lista de produtos do estado global
    computed: {
        products() {
            return this.$store.state.products.items;
        },
    },
    methods: {
        // Método para obter a URL da imagem ou a imagem padrão se não existir
        getImageUrl(image) {
            if (image) {
                return "/storage/products/" + image;
            } else {
                return "/public/img/default.jpg";
            }
        },
        paginate(page) {
            // Atualiza a variável de estado da página atual no componente
            this.currentPage = page;

            // Dispara a ação para carregar os produtos da página selecionada
            this.$store.dispatch("loadProducts", { name: this.name, page });
        },
    },
};
</script>

<style scoped>
.img-product img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;
}
</style>

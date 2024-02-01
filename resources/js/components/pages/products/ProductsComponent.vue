<template>
    <div class="container" v-if="products && products.meta">
        <h1>Listagem de Produtos</h1>

        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <SearchProductComponent @searchProduct="search" />

                    <router-link
                        :to="{ name: 'admin.product.create' }"
                        class="btn btn-success btn-custom"
                    >
                        Cadastrar
                    </router-link>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th width="100">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products.data" :key="index">
                    <td>{{ product.id }}</td>
                    <td class="img-product">
                        <img
                            :src="'/storage/products/' + product.image"
                            alt="Imagem do Produto"
                        />
                    </td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td class="acctions">
                        <router-link
                            :to="{
                                name: 'admin.product.datail',
                                params: { id: product.id },
                            }"
                            class="btn btn-light primary-btn-acction"
                            ><i class="fas fa-eye"></i
                        ></router-link>
                        <router-link
                            :to="{
                                name: 'admin.products.edit',
                                params: { id: product.id },
                            }"
                            class="btn btn-warning primary-btn-acction"
                            ><i class="fas fa-edit"></i
                        ></router-link>
                        <a
                            href=""
                            class="btn btn-danger"
                            @click.prevent="confirmDestroy(product)"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Paginação -->
        <PaginationComponent
            :currentPage="currentPage"
            :lastPage="products.meta.last_page"
            :changePage="paginate"
        />
    </div>
</template>

<script>
import { notify } from "@kyvg/vue3-notification";
import SearchProductComponent from "../../common/SearchProductComponent.vue";
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
        this.$store.dispatch("loadProducts", { name: this.name });
    },
    computed: {
        products() {
            return this.$store.state.products.items;
        },
    },
    methods: {
        confirmDestroy(product) {
            if (
                window.confirm(
                    `Tem certeza de que deseja excluir o produto: ${product.name}?`
                )
            ) {
                this.destroy(product);
            }
        },
        destroy(product) {
            this.$store
                .dispatch("destroyProduct", product.id)
                .then(() => {
                    notify({
                        title: `Sucesso ao deletar o produto: ${product.name}`,
                        type: "success",
                    });
                })
                .catch((error) => {
                    notify({
                        title: "Error ao deletar produto",
                        type: "error",
                    });
                });
        },
        search(filter) {
            this.$store.dispatch("loadProducts", { name: filter, page: 1 });
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
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}
</style>

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

        <table class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Price</th>
                    <th width="100">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products.data" :key="index">
                    <td>{{ product.id }}</td>
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
                                name: '',
                            }"
                            class="btn btn-warning"
                            ><i class="fas fa-edit"></i
                        ></router-link>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="pagination">
            <nav aria-label="Navegação de página">
                <ul class="pagination">
                    <li class="page-item" :class="{ disabled: products.meta.current_page === 1 }">
                        <a class="page-link" @click="paginate(products.meta.current_page - 1)" href="#" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li>
                        <span class="page-link" v-if="products.meta.current_page">{{ products.meta.current_page }}</span>
                    </li>
                    <li class="page-item" :class="{ disabled: products.meta.current_page === products.meta.last_page }">
                        <a class="page-link" @click="paginate(products.meta.current_page + 1)" href="#" aria-label="Próxima">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import SearchProductComponent from "./partials/SearchProductComponent.vue";

export default {
    components: {
        SearchProductComponent,
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
        search(filter) {
            this.$store.dispatch("loadProducts", { name: filter, page: 1 });
        },
        paginate(page) {
            // Verifica se o número da página está fora dos limites válidos, Retorna se for válido
            if (page < 1 || page > this.products.meta.last_page) {
                return;
            }
            // Atualiza a variável de estado da página atual no componente
            this.currentPage = page;

            // Dispara a ação para carregar os produtos da página selecionada
            this.$store.dispatch("loadProducts", { name: this.name, page });
        }
    },
};
</script>

<style scoped>

</style>

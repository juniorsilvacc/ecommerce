<template>
    <div class="container">
        <h1>Listagem de Produtos</h1>

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
                                params: { id: product.id }
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
    </div>
</template>

<script>
import { notify } from "@kyvg/vue3-notification";

export default {
    components: {},
    data() {
        return {
            name: "",
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
    methods: {},
};
</script>

<style scoped></style>

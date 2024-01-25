<template>
    <div>
        <form
            class="form"
            @submit.prevent="onSubmit"
            enctype="multipart/form-data"
        >
            <div class="form-group mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input
                    type="text"
                    v-model="product.name"
                    class="form-control"
                    id="name"
                    required
                />
            </div>

            <div class="form-group mb-3">
                <label for="price" class="form-label">Preço:</label>
                <input
                    type="number"
                    v-model="product.price"
                    class="form-control"
                    id="price"
                    required
                />
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <input
                    type="text"
                    v-model="product.description"
                    class="form-control"
                    id="description"
                />
            </div>

            <div class="form-group mb-3">
                <label for="category" class="form-label">Categoria:</label>
                <select
                    v-model="product.category_id"
                    class="form-control"
                    id="category_id"
                    name="category_id"
                    required
                >
                    <option value="">Selecione a Categoria</option>
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="image" class="form-label">Imagem:</label>
                <input
                    type="file"
                    class="form-control"
                    id="image"
                    @change="handleImageUpload"
                    required
                />
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import { notify } from "@kyvg/vue3-notification";

export default {
    data() {
        return {
            product: {
                name: "",
                price: null,
                description: "",
                category_id: "",
                image: null,
            },
            categories: [],
        };
    },
    mounted() {
        // Chame a função para carregar as categorias quando o componente for montado
        this.loadCategories();
    },
    methods: {
        async loadCategories() {
            // Requisição HTTP GET para obter as categorias
            const response = await axios.get("/api/v1/categories");

            // Atribua os dados de categorias à variável categories
            this.categories = response.data.data;
        },
        async onSubmit() {
            try {
                const formData = new FormData();

                // Adiciona os campos do produto ao FormData
                formData.append("name", this.product.name);
                formData.append("price", this.product.price);
                formData.append("description", this.product.description);
                formData.append("category_id", this.product.category_id);

                // Adiciona a imagem ao FormData (se estiver presente)
                if (this.product.image) {
                    formData.append("image", this.product.image);
                }

                // Envia o FormData para a ação storeProduct
                await this.$store.dispatch("storeProduct", formData);

                // Limpar o formulário ou realizar outras ações após o envio bem-sucedido
                this.product = {
                    name: "",
                    price: null,
                    description: "",
                    category_id: "",
                    image: null,
                };

                notify({
                    title: "Produto",
                    text: "Produto Adicionado Com Sucesso",
                    type: "success",
                });
            } catch (error) {
                let msgError = "Falha na Requisição";

                if (error.response && error.response.status === 422) {
                    const validationErrors = error.response.data.errors;

                    const formattedErrors = Object.entries(validationErrors)
                        .map(
                            ([field, messages]) =>
                                `${field}: ${messages.join(", ")}`
                        )
                        .join(", ");

                    msgError = `Erros de validação: ${formattedErrors}`;
                } else if (error.response && error.response.status === 404) {
                    msgError = "Produto Não Encontrado";
                }

                notify({
                    title: "Falha ao Processar Produto",
                    text: msgError,
                    type: "error",
                });
            }
        },
        handleImageUpload(event) {
            const file = event.target.files[0];

            if (file) {
                this.product.image = file;
            }
        },
    },
};
</script>

<style scoped></style>

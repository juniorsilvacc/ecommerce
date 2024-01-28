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
                    <option :value="null">Selecione a Categoria</option>
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
                />
            </div>

            <input type="hidden" name="_method" value="PUT" />

            <button type="submit" class="btn btn-primary">
                {{ updating ? "Atualizar" : "Enviar" }}
            </button>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import { notify } from "@kyvg/vue3-notification";

export default {
    props: {
        product: {
            type: Object,
            default: () => ({
                id: "",
                name: "",
                description: "",
                price: null,
                category_id: "",
                image: null,
            }),
        },
        updating: {
            required: false,
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            categories: [],
            errorMessages: [],
            isSubmitting: false,
        };
    },
    beforeMount() {
        this.loadCategories();
    },
    methods: {
        async loadCategories() {
            const response = await axios.get("/api/v1/categories");

            this.categories = response.data.data;
        },
        async onSubmit() {
            try {
                this.isSubmitting = true;
                this.errorMessages = [];

                if (this.updating) {
                    await this.createOrUpdateProduct(
                        "updateProduct",
                        "Produto Atualizado Com Sucesso"
                    );
                } else {
                    await this.createOrUpdateProduct(
                        "storeProduct",
                        "Produto Adicionado Com Sucesso"
                    );
                }
            } catch (error) {
                this.handleErrors(error);
            }
        },
        async createOrUpdateProduct(action, successMessage) {
            try {
                const formData = new FormData();
                const isUpdate = this.updating;

                // Campos formData
                formData.append("name", this.product.name);
                formData.append("price", this.product.price);
                formData.append("description", this.product.description);
                formData.append("category_id", this.product.category_id);

                // Campos específicos para atualização
                if (isUpdate) {
                    formData.append("id", this.product.id);
                    formData.append("_method", "PUT");
                }

                // Adicione a imagem se houver
                if (this.product.image !== null) {
                    formData.append("image", this.product.image);
                }

                // Despache a ação
                await this.$store.dispatch(action, {
                    productId: this.product.id,
                    data: formData,
                });

                notify({
                    title: "Produto",
                    text: successMessage,
                    type: "success",
                });
            } catch (error) {
                this.handleErrors(error);
            }
        },
        handleErrors(error) {
            let messageError = "Falha na Requisição";

            if (error.response && error.response.status === 422) {
                const validationErrors = error.response.data.errors;
                this.errorMessages = Object.entries(validationErrors).map(
                    ([field, messages]) => `${field}: ${messages.join(", ")}`
                );
            } else {
                this.errorMessages = [
                    "Erro desconhecido ao processar a solicitação.",
                ];
            }

            notify({
                title: "Falha ao Processar Produto",
                text: messageError,
                type: "error",
            });
        },
        handleImageUpload(event) {
            // const file = event.target.files[0];

            // if (file) {
            //     this.product.image = file;
            // }
            const files = event.target.files;

            if (files.length > 0) {
                this.product.image = files[0];
            } else {
                this.product.image = null;
            }
        },
    },
};
</script>

<style scoped></style>

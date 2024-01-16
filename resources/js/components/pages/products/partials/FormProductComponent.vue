<template>
    <div>
        <form class="form" @submit.prevent="onSubmit">
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
                    v-model="product.category"
                    class="form-control"
                    id="category"
                    required
                >
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
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { notify } from "@kyvg/vue3-notification";

export default {
    props: {
        product: {
            type: Object,
            default: () => ({
                id: "",
                name: "",
                price: "",
                description: "",
                category: "",
                image: "",
            }),
        },
        updating: {
            require: false,
            type: Boolean,
            default: false,
        },
    },
    methods: {
        handleImageUpload(event) {
            const fileInput = event.target;
            const file = fileInput.files?.[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    this.product.image = reader.result;
                };
                reader.readAsDataURL(file);
            }
        },
    },
    setup(props) {
        const store = useStore();
        const router = useRouter();

        const onSubmit = async () => {
            try {
                await store.dispatch("storeProduct", props.product);

                router.push({ name: "admin.products" });

                notify({
                    title: "Produto",
                    text: "Produto Adicionada Com Sucesso",
                    type: "success",
                });
            } catch (error) {
                let msgError = "Falha na Requisição";

                if (error.response && error.response.status === 422) {
                    const validationErrors = error.response.data.errors;

                    const formattedErrors = Object.values(validationErrors)
                        .flat()
                        .join(", ");

                    msgError = `${formattedErrors}`;
                } else if (error.response && error.response.status === 404) {
                    msgError = "Produto Não Encontrada";
                    router.push({ name: "admin.products" });
                }

                notify({
                    title: "Falha ao Processar Produto",
                    text: msgError,
                    type: "error",
                });
            }
        };

        return {
            onSubmit,
        };
    },
};
</script>

<style scoped></style>

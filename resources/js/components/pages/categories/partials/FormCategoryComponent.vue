<template>
    <div>
        <form class="form" @submit.prevent="onSubmit">
            <div class="form-group mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input
                    type="text"
                    v-model="category.name"
                    class="form-control"
                    id="name"
                    required
                />
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <input
                    type="text"
                    v-model="category.description"
                    class="form-control"
                    id="description"
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
        category: {
            type: Object,
            default: () => ({
                id: "",
                name: "",
                description: "",
            }),
        },
        updating: {
            require: false,
            type: Boolean,
            default: false,
        },
    },
    setup(props) {
        const store = useStore();
        const router = useRouter();

        const onSubmit = async () => {
            try {
                if (props.updating) {
                    await store.dispatch("updateCategory", props.category);
                } else {
                    await store.dispatch("storeCategory", props.category);
                    notify({
                        title: "Categoria",
                        text: "Categoria adicionada com sucesso",
                        type: "success",
                    });
                }

                router.push({ name: "admin.categories" });
            } catch (error) {
                let msgError = "Falha na requisição";

                // Verifica se a resposta da API possui um status 422
                if (error.response && error.response.status === 422) {

                    // Verifica se a resposta contém detalhes específicos de erros de validação.
                    if (error.response.data && error.response.data.errors) {
                        // Extrai os erros de validação da resposta da API.
                        const validationErrors = error.response.data.errors;

                        // Formata os erros em uma string, unindo-os com uma vírgula.
                        const formattedErrors = Object.values(validationErrors)
                            .flat()
                            .join(', ');

                        // Atualiza a mensagem de erro para incluir os detalhes dos erros de validação.
                        msgError = `${formattedErrors}`;
                    }
                } else if (error.response && error.response.status === 404) {
                    msgError = "Categoria não encontrada";
                    router.push({ name: "admin.categories" });
                }

                notify({
                    title: "Falha ao Processar Categoria",
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

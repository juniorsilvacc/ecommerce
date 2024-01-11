<template>
    <div class="container">
        <div>
            <h1>Adicionar nova categoria</h1>
        </div>

        <form class="form" @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input
                    type="text"
                    v-model="name"
                    class="form-control"
                    id="name"
                    required
                />
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Descrição:</label>
                <input
                    type="text"
                    v-model="description"
                    class="form-control"
                    id="description"
                />
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</template>

<script>
import { ref } from "vue";
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default {
    setup() {
        const store = useStore();
        const router = useRouter();

        // Define variáveis reativas para os campos do formulário
        const name = ref("");
        const description = ref("");

        // Função assíncrona para lidar com o envio do formulário
        const submitForm = async () => {
            try {
                // Despacha uma ação para armazenar a categoria no Vuex Store
                await store.dispatch("storeCategory", {
                    name: name.value,
                    description: description.value,
                });

                router.push({ name: "admin.categories" });
            } catch (error) {
                console.log(error);
            }
        };

        // Retorna as variáveis e funções necessárias para o componente
        return {
            name,
            description,
            submitForm,
        };
    },
};
</script>

<style scoped></style>

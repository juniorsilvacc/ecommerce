<template>
    <div>
        <form class="form" @submit.prevent="onSubmit">
            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input
                    type="text"
                    v-model="category.name"
                    class="form-control"
                    id="name"
                    required
                />
            </div>
            <div class="mb-3">
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
                }

                router.push({ name: "admin.categories" });
            } catch (error) {
                console.error(error);
            }
        };

        return {
            onSubmit,
        };
    },
};
</script>

<style scoped></style>

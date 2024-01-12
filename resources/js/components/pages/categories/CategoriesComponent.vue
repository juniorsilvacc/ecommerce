<template>
    <div class="container">
        <h1>Listagem de Categorias</h1>

        <router-link
            :to="{ name: 'admin.categories.create' }"
            class="btn btn-success"
            >Cadastrar</router-link
        >

        <table class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th width="100">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(category, index) in categories.data" :key="index">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td class="acctions">
                        <router-link
                            :to="{
                                name: 'admin.categories.edit',
                                params: { id: category.id },
                            }"
                            class="btn btn-warning edit"
                            ><i class="fas fa-edit"></i
                        ></router-link>
                        <a
                            href=""
                            class="btn btn-danger"
                            @click.prevent="confirmDestroy(category)"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </a>

                        <div
                            v-if="showConfirmationModal"
                            class="confirmation-modal"
                        >
                            <p>
                                Você tem certeza de que deseja excluir a
                                categoria "{{ categoryToDelete.name }}"?
                            </p>
                            <button @click="cancelDelete">Cancelar</button>
                            <button @click="confirmDelete">Confirmar</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { notify } from "@kyvg/vue3-notification";

export default {
    data() {
        return {
            showConfirmationModal: false,
            categoryToDelete: null,
        };
    },
    created() {
        this.$store.dispatch("loadCategories");
    },
    computed: {
        categories() {
            return this.$store.state.categories.items;
        },
    },
    methods: {
        confirmDestroy(category) {
            this.categoryToDelete = category;
            this.showConfirmationModal = true;
        },

        cancelDelete() {
            this.showConfirmationModal = false;
            this.categoryToDelete = null;
        },

        confirmDelete() {
            this.destroy(this.categoryToDelete);
            this.showConfirmationModal = false;
            this.categoryToDelete = null;
        },
        destroy(category) {
            this.$store
                .dispatch("destroyCategory", category.id)
                .then(() => {
                    notify({
                        title: `Sucesso ao deletar a categoria ${category.name}`,
                        type: "success",
                    });
                })
                .catch((error) => {
                    notify({
                        title: "Error ao deletar categoria",
                        type: "error",
                    });
                });
        },
    },
};
</script>

<style scoped>
.acctions {
    display: flex;
}
.edit {
    margin-right: 10px;
}

.confirmation-modal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: rgba(34, 34, 34, 0.7);
  padding: 20px;
  z-index: 1000;
  width: 300px;
  border-radius: 8px;
  text-align: center;
  font-family: 'Arial', sans-serif;
}

.confirmation-modal p {
  margin-bottom: 20px;
  color: #fff;
}

.confirmation-modal button {
  background-color: #f55964;
  color: #fff;
  border: none;
  padding: 10px 20px;
  margin: 0 10px;
  cursor: pointer;
  border-radius: 4px;
  font-size: 14px;
  transition: background-color 0.3s;
}

.confirmation-modal button:hover {
  background-color: #d22c38;
}
</style>

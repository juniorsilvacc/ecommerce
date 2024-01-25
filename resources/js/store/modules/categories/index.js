// Importa o axios para fazer requisições HTTP
import axios from "axios";

export default {
    // O estado do módulo
    state: {
        // Um objeto que contém a propriedade 'items', que é inicializada como um objeto com a propriedade 'data' inicializada como um array vazio
        items: {
            data: [],
        },
    },
    // As mutações são funções responsáveis por alterar o estado
    mutations: {
        // Uma mutação chamada 'LOAD_CATEGORIES', que recebe o estado e as categorias como parâmetros
        LOAD_CATEGORIES (state, categories) {
            // Atualiza a propriedade 'items' do estado com os dados recebidos
            state.items = categories;
        }
    },
    // As ações são funções assíncronas que podem chamar mutações
    actions: {
        async loadCategories (context, params) {
            context.commit('CHANGE_PRELOADER', true);

            try {
                const response = await axios.get('/api/v1/categories', { params });
                context.commit('CHANGE_PRELOADER', false);
                context.commit('LOAD_CATEGORIES', response.data);
                return response;
            } catch (error) {
                context.commit('CHANGE_PRELOADER', false);
                throw error;
            }
        },

        loadCategory (context, id) {
            context.commit('CHANGE_PRELOADER', true);

            return new Promise((resolve, reject) => {
                axios.get(`/api/v1/categories/${id}/details`)
                    .then(response => resolve(response.data))
                    .catch(error => reject(error))
                    .finally(() => {
                        context.commit('CHANGE_PRELOADER', false);
                    })
            })
        },

        storeCategory (context, params) {
            context.commit('CHANGE_PRELOADER', true);

            return new Promise((resolve, reject) => {
                axios.post('/api/v1/categories/create', params)
                    .then(response => resolve(response.data))
                    .catch(error => reject(error))
                    .finally(() => {
                        context.commit('CHANGE_PRELOADER', false);
                    })
            })
        },

        updateCategory (context, params) {
            context.commit('CHANGE_PRELOADER', true);

            return new Promise((resolve, reject) => {
                axios.put(`/api/v1/categories/${params.id}/update`, params)
                    .then(response => resolve(response.data))
                    .catch(error => reject(error))
                    .finally(() => {
                        context.commit('CHANGE_PRELOADER', false);
                    })
            })
        },

        destroyCategory (context, categoryId) {
            context.commit('CHANGE_PRELOADER', true);

            return new Promise((resolve, reject) => {
                axios.delete(`/api/v1/categories/${categoryId}/delete`)
                    .then(response => {
                        context.dispatch('loadCategories'); // Se necessário, recarregue a lista de categorias após a exclusão
                        resolve(response.data);
                    })
                    .catch(error => reject(error))
                    .finally(() => {
                        context.commit('CHANGE_PRELOADER', false);
                    });
            });
        }
    },
    // Getters são funções para acessar o estado em componentes Vue
    getters: {
        // Poderiam ser adicionados getters aqui se necessário
    },
};

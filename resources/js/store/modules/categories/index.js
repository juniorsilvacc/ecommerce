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
            state.items = categories.data;
        }
    },
    // As ações são funções assíncronas que podem chamar mutações
    actions: {
        // Uma ação chamada 'loadCategories', que recebe o contexto como parâmetro
        loadCategories (context) {
            context.commit('CHANGE_PRELOADER', true);


            // Faz uma requisição GET para a API de categorias
            axios.get('/api/v1/categories')
                .then(response => {
                    // Chama a mutação 'LOAD_CATEGORIES' com os dados da resposta da API
                    context.commit('LOAD_CATEGORIES', response)
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    context.commit('CHANGE_PRELOADER', false);
                })
        },

        storeCategory (context, params) {
            context.commit('CHANGE_PRELOADER', true);

            return new Promise((resolve, reject) => {
                axios.post('/api/v1/categories/create', params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => {
                        context.commit('CHANGE_PRELOADER', false);
                    })
            })
        }
    },
    // Getters são funções para acessar o estado em componentes Vue
    getters: {
        // Poderiam ser adicionados getters aqui se necessário
    },
};

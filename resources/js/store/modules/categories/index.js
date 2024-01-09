import axios from "axios";

export default {
    state: {
        items: {
            data: [],
        },
    },
    mutations: {
        LOAD_CATEGORIES (state, categories) {
            state.items = categories.data;
        }
    },
    actions: {
        loadCategories (context) {
            axios.get('/api/v1/categories')
                .then(response => {
                    context.commit('LOAD_CATEGORIES', response)
                })
                .catch(errors => {
                    console.log(errors)
                })
        }
    },
    getters: {
    },
};

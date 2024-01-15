import axios from "axios";

export default {
    state: {
        items: {
            data: [],
        }
    },
    mutations: {
        LOAD_PRODUCTS (state, products) {
            state.items = products.data;
        }
    },
    actions: {
        loadProducts (context, params) {
            context.commit('CHANGE_PRELOADER', true);

            axios.get('/api/v1/products', { params })
                .then(response => {
                    context.commit('LOAD_PRODUCTS', response)
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    context.commit('CHANGE_PRELOADER', false);
                })
        }
    },
    getters: {

    }
}

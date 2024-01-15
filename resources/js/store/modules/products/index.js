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
                    throw error;
                })
                .finally(() => {
                    context.commit('CHANGE_PRELOADER', false);
                })
        },
        async loadProduct(context, id) {
            context.commit('CHANGE_PRELOADER', true);

            try {
                const response = await axios.get(`/api/v1/products/${id}/details`);
                context.commit('CHANGE_PRELOADER', false);
                return response.data;
            } catch (error) {
                context.commit('CHANGE_PRELOADER', false);
                throw error;
            }
        }
    },
    getters: {

    }
}

import axios from "axios";
import { URL_BASE } from '../../../config/configs';

const RESOURCE = 'products'

export default {
    async loadProducts (context, params) {
        context.commit('CHANGE_PRELOADER', true);

        try {
            const response = await axios.get(`${URL_BASE}${RESOURCE}`, { params });
            context.commit('CHANGE_PRELOADER', false);
            context.commit('LOAD_PRODUCTS', response.data);
        } catch (error) {
            context.commit('CHANGE_PRELOADER', false);
            throw error;
        }
    },
    async loadProduct(context, id) {
        context.commit('CHANGE_PRELOADER', true);

        try {
            const response = await axios.get(`${URL_BASE}${RESOURCE}/${id}/details`);
            context.commit('CHANGE_PRELOADER', false);
            return response.data;
        } catch (error) {
            context.commit('CHANGE_PRELOADER', false);
            throw error;
        }
    },
    async storeProduct(context, params) {
        context.commit('CHANGE_PRELOADER', true);

        try {
            const response = await axios.post(`${URL_BASE}${RESOURCE}/create`, params);
            context.commit('CHANGE_PRELOADER', false);
            return response.data;
        } catch (error) {
            context.commit('CHANGE_PRELOADER', false);
            throw error;
        }
    }
}

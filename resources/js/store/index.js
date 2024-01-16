import { createStore } from 'vuex';

import Categories from './modules/categories';
import products from './modules/products';
import preloader from './modules/preloader';

const store = createStore({
  modules: {
    categories: Categories,
    products,
    preloader
  },
});

export default store;

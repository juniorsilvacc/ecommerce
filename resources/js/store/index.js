import { createStore } from 'vuex';

import Categories from './modules/categories';
import Products from './modules/products';
import preloader from './modules/preloader';

const store = createStore({
  modules: {
    categories: Categories,
    products: Products,
    preloader
  },
});

export default store;

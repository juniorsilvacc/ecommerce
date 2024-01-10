import { createStore } from 'vuex';

import Categories from './modules/categories';
import preloader from './modules/preloader';

const store = createStore({
  modules: {
    categories: Categories,
    preloader
  },
});

export default store;

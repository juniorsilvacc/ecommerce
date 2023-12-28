import { createStore } from 'vuex';

import Categories from './modules/categories';

const store = createStore({
  modules: {
    categories: Categories
  },
});

export default store;

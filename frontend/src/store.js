//vuex store for state managment after five hours

import { createStore } from 'vuex';

export default createStore({
  state: {
    refreshBooks: false
  },
  mutations: {
    setRefreshBooks(state, value) {
      state.refreshBooks = value;
    }
  }
});

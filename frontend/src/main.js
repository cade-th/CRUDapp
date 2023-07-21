import { createApp } from 'vue'
import { createStore } from 'vuex'
import App from './App.vue'
import router from './router'

//create a new store instance
const store = createStore({
  state () {
    return {
      refreshBooks: false
    }
  },
  //vuex shit
  mutations: {
    setRefreshBooks (state, newValue) {
      state.refreshBooks = newValue
    }
  }
})

createApp(App).use(store).use(router).mount('#app')



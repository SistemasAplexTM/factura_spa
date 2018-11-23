import Vue from 'vue'
import Vuex from 'vuex'
import app from './modules/app'
import payment from './modules/payments'
import terceros from './modules/terceros'
import getters from './getters'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    app,
    payment,
    terceros
  },
  getters
})

export default store

import Vue from 'vue'
import Vuex from 'vuex'
import app from './modules/app'
import payment from './modules/payments'
import terceros from './modules/terceros'
import cupons from './modules/cupons'
import documents from './modules/documents'
import getters from './getters'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    app,
    payment,
    terceros,
    cupons,
    documents
  },
  getters
})

export default store

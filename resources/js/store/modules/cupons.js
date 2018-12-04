import { cuponsById } from '@/api/cupons'

const cupons = {
  state: {
    cupons_editing: {}
  },

  mutations: {
    SET_CUPONS_EDITING: (state, cupons_editing) => {
      state.cupons_editing = cupons_editing
    }
  },

  actions: {
    cuponsEditing({ commit }, id){
      if (!id) {
        commit('SET_CUPONS_EDITING', '')
        return false
      }else{
        return new Promise((resolve, reject) => {
          cuponsById(id).then(response => {
            if (!response.data) {
              reject('error')
            }
            commit('SET_CUPONS_EDITING', response.data)
          }).catch(error => {
            reject(error)
          })
        })
      }
    },
  }
}

export default cupons
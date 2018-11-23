import { terceroById } from '@/api/tercero'

const tercero = {
  state: {
    tercero_editing: {}
  },

  mutations: {
    SET_TERCERO_EDITING: (state, tercero_editing) => {
      state.tercero_editing = tercero_editing
    }
  },

  actions: {
    terceroEditing({ commit }, id){
      if (!id) {
        commit('SET_TERCERO_EDITING', '')
        return false
      }else{
        return new Promise((resolve, reject) => {
          terceroById(id).then(response => {
            if (!response.data) {
              reject('error')
            }
            commit('SET_TERCERO_EDITING', response.data)
          }).catch(error => {
            reject(error)
          })
        })
      }
    },
  }
}

export default tercero
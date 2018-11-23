import { paymentById } from '@/api/payment'

const payment = {
  state: {
    payment_editing: {}
  },

  mutations: {
    SET_PAYMENT_EDITING: (state, payment_editing) => {
      state.payment_editing = payment_editing
    }
  },

  actions: {
    paymentEditing({ commit }, id){
      if (!id) {
        commit('SET_PAYMENT_EDITING', '')
        return false
      }else{
        return new Promise((resolve, reject) => {
          paymentById(id).then(response => {
            if (!response.data) {
              reject('error')
            }
            commit('SET_PAYMENT_EDITING', response.data)
          }).catch(error => {
            reject(error)
          })
        })
      }
    },
  }
}

export default payment
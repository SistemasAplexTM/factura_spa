const app = {
  state: {
    sidebar: true,
    money: {
      decimal: ',',
      thousands: '.',
      prefix: '$ ',
      suffix: '',
      precision: 0,
      masked: false /* doesn't work with directive */
    }
  },
  mutations: {
    TOGGLE_SIDEBAR: state => {
      state.sidebar = !state.sidebar
    },
    REFRESH_TABLE: (table) => {
      this.$refs[table].getData()
    }
  },
  actions: {
    toggleSideBar({ commit }) {
      commit('TOGGLE_SIDEBAR')
    }
  }
}

export default app

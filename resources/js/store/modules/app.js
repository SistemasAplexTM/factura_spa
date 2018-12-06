const app = {
  state: {
    sidebar: true,
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

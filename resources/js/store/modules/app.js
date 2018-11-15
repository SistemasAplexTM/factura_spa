const app = {
  state: {
    sidebar: false,
  },
  mutations: {
    TOGGLE_SIDEBAR: state => {
      state.sidebar = !state.sidebar
    }
  },
  actions: {
    toggleSideBar({ commit }) {
      commit('TOGGLE_SIDEBAR')
    }
  }
}

export default app

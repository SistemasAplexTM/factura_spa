import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)
// import Layout from '../views/layout/Layout'
import Layout from '../views/layouts/Index'

export const routes = [
  {
    path: '/', component: Layout
  },
  {
    path: 'home', component: Layout
  }
]

const router = new Router({
  mode: 'history',
  routes: routes
})

export default router

import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
// Middleware
import verifySetup from '@/utils/verifySetup'
// Componentes
import Errors from './modules/error'
import Layout from '../views/layout/Layout'
import Payments from '../views/payment/Index'
import Terceros from '../views/tercero/Index'
import Cupons from '../views/cupons/Index'
import Documents from '../views/documents/Index'
import Setup from '../views/layout/Setup'

export const routes = [{
        path: '/',
        component: Layout,
        children: [
          {
            path: '/',
            component: Documents,
          },
          {
            path: '/documents',
            component: Documents
          },
          {
            path: '/payments',
            component: Payments
          },
          {
            path: '/terceros',
            component: Terceros
          },
          {
            path: '/cupons',
            component: Cupons
          }
        ]
    },
    {
      path: '/setup',
      component: Setup,
    },
    Errors
]

const router = new Router({
    mode: 'history',
    routes
})

router.beforeEach(verifySetup);

export default router

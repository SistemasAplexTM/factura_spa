import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import errors from './modules/error'
import Layout from '../views/layouts/Index'
import Payments from '../views/payment/Index'
import Terceros from '../views/tercero/Index'
import Cupons from '../views/cupons/Index'
import Documents from '../views/documents/Index'

export const routes = [{
        path: '/',
        component: Layout,
        children: [{
            path: '/home',
            component: Layout
        }, {
            path: '/payments',
            component: Payments
        },{
            path: '/terceros',
            component: Terceros
        },{
            path: '/cupons',
            component: Cupons
        },{
            path: '/documents',
            component: Documents
        }]
    },
    errors
]

const router = new Router({
    mode: 'history',
    routes
})
export default router
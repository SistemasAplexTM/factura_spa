window._ = require('lodash');
import { logout } from '@/api/auth'
import Vue from 'vue'
window.axios = require('axios')

import 'normalize.css/normalize.css' // A modern alternative to CSS resets

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/es'
import 'element-ui/lib/theme-chalk/index.css';

import './styles/index.scss' // global css
import App from './App.vue'

import router from './router'
import store from './store'

import VTooltip from 'v-tooltip'

import bulma from 'bulma'

Vue.use(bulma)

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
// import { fab } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(fas)

Vue.component('fa', FontAwesomeIcon)

Vue.use(ElementUI, { locale });
Vue.use(VTooltip)

import IconAplex from '@/components/Icon/Icon'
Vue.component('icon-aplex', IconAplex)

// window.onbeforeunload = function() {
//   alert('Cerrar?')
//   logout().then(({data}) => {
//     if (data.code == 200) {
//       localStorage.removeItem('setup')
//     }
//   }).catch(error => {
//     console.log(error);
//   })
//   return;
// };

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});

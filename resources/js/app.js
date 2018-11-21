window._ = require('lodash');
import Vue from 'vue'
window.axios = require('axios')

import 'normalize.css/normalize.css' // A modern alternative to CSS resets

import ElementUI from 'element-ui';
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

Vue.use(ElementUI);
Vue.use(VTooltip)

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});

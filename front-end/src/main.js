import Vue from 'vue'
import router from './router/'
import './registerServiceWorker'
import './plugins/vuetify'
import './theme/default.sass'

import App from './App.vue'
import vuetify from './plugins/vuetify'
import '@mdi/font/css/materialdesignicons.css'
import 'jodit/build/jodit.css'
import pt_BR from 'vee-validate/dist/locale/pt_BR.json'
import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate'
import * as rules from 'vee-validate/dist/rules'
import auth from './plugins/auth'
import VueAxios from 'vue-axios'
import VueAuth from '@websanova/vue-auth'
import axios from 'axios'

Vue.config.productionTip = false

axios.defaults.baseURL = process.env.VUE_APP_BASE_API
axios.defaults.headers = {
  'Access-Control-Allow-Methods': '*',
}

Vue.router = router

Vue.use(VueAxios, axios)
Vue.use(VueAuth, auth)

Object.keys(rules).forEach((rule) => {
  extend(rule, rules[rule])
})
localize('pt_BR', pt_BR)
Vue.component('ValidationObserver', ValidationObserver)
Vue.component('ValidationProvider', ValidationProvider)

const app = new Vue({
  router,
  vuetify,
  render: (h) => h(App),
})
app.$mount('#app')

import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'
const config = {
  auth: bearer,
  http: axios,
  router: router,
  tokenStore: ['localStorage'],
  loginData: { url: 'auth/login', method: 'POST', redirect: '', fetchUser: false },
  logoutData: { url: 'auth/logout', method: 'POST', redirect: '/auth/login', makeRequest: true },
  fetchData: { url: 'auth/user', method: 'GET', enabled: false },
  refreshData: { url: 'auth/refresh', method: 'GET', enabled: false, interval: 30 },
}
export default config

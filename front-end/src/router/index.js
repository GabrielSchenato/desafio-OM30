import Vue from 'vue'
import Router from 'vue-router'
import { publicRoute, protectedRoute } from './config'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'
const routes = publicRoute.concat(protectedRoute)

Vue.use(Router)
const router = new Router({
  mode: 'hash',
  linkActiveClass: 'active',
  routes: routes,
})
router.beforeEach((to, from, next) => {
  NProgress.start()
  next()
})

router.afterEach(() => {
  NProgress.done()
})

export default router

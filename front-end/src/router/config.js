import { LayoutAuth, LayoutDefault, LayoutMedia, RouteWrapper } from '@/components/layouts'

export const publicRoute = [
  {
    path: '*',
    component: () => import('@/views/error/NotFound.vue'),
  },
  {
    path: '/auth',
    component: LayoutAuth,
    meta: {
      title: 'Login',
    },
    redirect: '/auth/login',
    hidden: true,
    children: [
      {
        path: 'login',
        name: 'login',
        meta: {
          title: 'Login',
        },
        component: () => import('@/views/auth/Login.vue'),
      },
    ],
  },

  {
    path: '/404',
    name: '404',
    meta: {
      title: 'Not Found',
    },
    component: () => import('@/views/error/NotFound.vue'),
  },

  {
    path: '/500',
    name: '500',
    meta: {
      title: 'Server Error',
    },
    component: () => import('@/views/error/Error.vue'),
  },
]

export const protectedRoute = [
  {
    path: '/',
    component: LayoutDefault,
    meta: {
      title: 'Home',
      icon: '',
    },
    redirect: 'auth',
    children: [
      {
        path: '/patients',
        name: 'Pacientes',
        meta: {
          title: 'Pacientes',
          icon: 'mdi-account-multiple',
        },
        component: () => import('@/views/Patients.vue'),
      },

      {
        path: '/403',
        name: 'Forbidden',
        meta: {
          title: 'access_denied',
          hidden: true,
        },
        component: () => import('@/views/error/Deny.vue'),
      },
    ],
  },
]

import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Prova from '@/components/Prova'
import Login from '@/components/Login'
import MainLayout from '@/components/layouts/MainLayout'

Vue.use(Router)

let router = new Router({
  routes: [
    {
      path: '/',
      name: 'MainLayout',
      component: MainLayout,
      children: [
        {
          path: 'prova',
          name: 'Prova',
          component: Prova,
          meta: {
            requiredAuth: true
          }
        },
        {
          path: 'hello',
          alias: '',
          name: 'HelloWorld',
          component: HelloWorld
        }
      ]
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    }
  ]
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiredAuth) && (!router.app.$store.state.token || router.app.$store.state.token === 'null')) {
    window.console.log('BEFORE EACH ROUTE')
    const logged = true
    if (to.path === '/login') next()
    if (!logged) {
      next({
        path: '/login'
      })
    }
    next()
  }
})
export default router

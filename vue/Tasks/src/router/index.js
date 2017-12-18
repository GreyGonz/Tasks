import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Prova from '@/components/Prova'
import Login from '@/components/Login'
import MainLayout from '@/components/layouts/MainLayout'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'MainLayout',
      component: MainLayout,
      children: [
        {
          path: 'prova',
          name: 'Prova',
          component: Prova
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

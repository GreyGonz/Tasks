import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Landing from '@/components/Landing'
import Login from '@/components/Login'
import MainLayout from '@/components/MainLayout'
import Tasks from '@/components/Tasks'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Landing',
      component: Landing
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/',
      name: 'MainLayout',
      component: MainLayout,
      children: [
        {
          path: '/tasks',
          name: 'Tasks',
          component: Tasks
        },
        {
          path: '/helloworld',
          name: 'HelloWorld',
          component: HelloWorld
        }
      ]
    }
  ]
})

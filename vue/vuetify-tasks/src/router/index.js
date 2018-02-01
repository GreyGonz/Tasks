import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Landing from '@/components/Landing'
import Login from '@/components/Login'
import MainLayout from '@/components/MainLayout'
import Tasks from '@/components/Tasks'
import Register from '@/components/Register'
import Counter from '@/components/counter'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Landing',
      component: Landing
    },
    {
      path: '/counter',
      name: 'Counter',
      component: Counter
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
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

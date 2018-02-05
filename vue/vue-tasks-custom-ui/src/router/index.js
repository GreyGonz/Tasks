import Vue from 'vue'
import Router from 'vue-router'
import MainLayout from '@/components/MainLayout'
import Landing from '@/components/Landing'
import Login from '@/components/Login'
import Tasks from '@/components/Tasks'
import Register from '@/components/Register'
import Layout from '@/components/Layout'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      component: Layout,
      children: [
        {
          path: '/',
          name: 'Landing',
          component: Landing
        },
        {
          path: 'register',
          name: 'Register',
          component: Register
        },
        {
          path: 'login',
          name: 'Login',
          component: Login
        }
      ]
    },
    {
      path: '/main',
      name: 'MainLayout',
      component: MainLayout,
      children: [
        {
          path: '/tasks',
          name: 'Tasks',
          component: Tasks
        }
      ]
    }
  ]
})

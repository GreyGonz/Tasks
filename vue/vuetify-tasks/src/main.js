// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Vuex from 'vuex'
// import axios from 'axios'

Vue.use(Vuetify)
Vue.use(Vuex)

const store = new Vuex.Store({
  strict: true, // Nomes es pot accedir a les variables a traves dels guetters i setters(mutations)
  state: {
    count: 0,
    tasks: []
  },
  getters: {
    count: state => {
      return state.count
    },
    tasks: state => {
      return state.tasks
    }
  },
  mutations: {
    increment (state) {
      // mutate state
      state.count++
    },
    decrement (state) {
      state.count--
    },
    count (state, count) {
      state.count = count
    },
    tasks (state, tasks) {
      state.tasks = tasks
    }
  },
  actions: {
    // Exemple de action. Les mutations s'utilitzen com a "setters"
    // les actions es fan servir per a fer més d'una cosa, una funcio qualsevol
    // Un altre exemple de action sería una funció que crea una tasca a través
    // de axios
    // incrementAndAddTask (state, task) {
    //   state.count++
    //   state.tasks[] = task
    // }
    fetchTasks (context) {
      // axios.get('api/v1/tasks').then((response) => {
      //   let tasks = response.data.data
      //   context.commit('tasks', tasks) // context funciona com un "this" de l'"state"
      // }).catch((error) => {
      //   console.log(error)
      // })
      let tasks = [
        { 'name': 'Go' },
        { 'name': 'Go' },
        { 'name': 'Go' }
      ]
      context.commit('tasks', tasks)
    }
  }
})

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})

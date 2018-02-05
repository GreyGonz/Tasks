import Vuex from 'vuex'
import Vue from 'vue'
import actions from './actions'
import mutations from './mutations'
import * as getters from './getters'

Vue.use(Vuex)

const store = new Vuex.Store({
  strict: true, // Nomes es pot accedir a les variables a traves dels guetters i setters(mutations)
  state: {
    count: 0,
    tasks: []
  },
  getters,
  mutations,
  actions
})

export default store

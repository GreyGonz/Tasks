<template>
  <div>
    <button @click="increment">+Button</button>
    <button @click="decrement">-Button</button>
    {{ count }}
    <div>
      <ul>
        <li v-for="(task, index) in tasks" :key="index">
          {{ task.name }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>

import { mapGetters } from 'vuex'
import * as actions from '../store/action-types'
import * as mutations from '../store/mutation-types'

export default {
  name: 'name',
  computed: {
    // count () {
    //   this.$store.state.count
    // },
    ...mapGetters(['count', 'tasks']) // Crida getter store
  },
  methods: {
    // Mutations
    increment () {
      this.$store.commit(mutations.INCREMENT)
    },
    decrement () {
      this.$store.commit(mutations.DECREMENT)
    }
  },
  mounted () {
    this.$store.dispatch(actions.FETCH_TASKS)
  }

}
</script>

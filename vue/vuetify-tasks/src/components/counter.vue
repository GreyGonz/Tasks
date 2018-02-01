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

import { mapGetters, mapMutations, mapActions } from 'vuex'

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
    // increment () {
    //   this.$store.commit('increment')
    // },
    // decrement () {
    //   this.$store.commit('decrement')
    // }
    ...mapMutations(['increment', 'decrement']), // Crida mutations store
    ...mapActions(['fetchTasks'])
  },
  mounted () {
    this.$store.dispatch('fetchTasks')
  }

}
</script>

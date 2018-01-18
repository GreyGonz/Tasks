<template>
    <tasks-crud-list id="tasks-crud-list" :loading="loading" :tasks="tasks"></tasks-crud-list>
</template>

<style>

</style>

<script>

  import axios from 'axios'
  import createApi from './api/tasks';

  const crud = createApi('/api/tasks');

  export default {
    name: 'TasksContainer',
    data() {
      return {
        tasks: [],
        loading: true
      }
    },
    mounted() {
      console.log(crud)
      crud.getAll().then( response => {
        this.tasks = response.data.data
      }).catch( error => {
        console.log(error)
      }).then(() => {
        this.loading = false
      })
    }
  }
</script>

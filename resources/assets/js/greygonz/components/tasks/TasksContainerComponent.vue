<template>
    <tasks-crud-list 
      id="tasks-crud-list" 
      :loading="loading"
      :tasks="tasks"
      :filteredTasks="filteredTasks"
      @visibility="setVisibility"
      @reload="reloadTasks"></tasks-crud-list>
</template>

<style>

</style>

<script>

  var filters = {
    all: function (tasks) {
      return tasks
    },
    active: function (tasks) {
      return tasks.filter(function (task) {
        return !task.completed
      })
    },
    completed: function (tasks) {
      return tasks.filter(function (task) {
        return task.completed
      })
    }
  }

  import axios from 'axios'
  import createApi from './api/tasks';

  const crud = createApi('/api/tasks');

  export default {
    name: 'TasksContainer',
    data() {
      return {
        tasks: [],
        loading: true,
        visibility: 'all'
      }
    },
    methods: {
      reloadTasks: function () {
        this.loading = true;
        crud.getAll().then( response => {
          this.tasks = response.data.data
        }).catch( error => {
          console.log(error)
        }).then(() => {
          this.loading = false
        })
      },
      setVisibility: function (visibilityValue) {
        this.visibility = visibilityValue
      }
    },
    computed: {
      filteredTasks: function () {
        return filters[this.visibility](this.tasks)
      },
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

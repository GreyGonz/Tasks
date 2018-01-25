<template>
    <tasks-crud-list 
      id="tasks-crud-list" 
      :loading="loading"
      :tasks="tasks"
      :filteredTasks="filteredTasks"
      :adding="adding"
      @adding="setAdding"
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
    pending: function (tasks) {
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
        visibility: 'all',
        adding: false
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
        this.visibility = visibilityValue;
      },
      setAdding: function (addingValue) {
        this.adding = addingValue;
      }

    },
    computed: {
      filteredTasks: function () {
        return filters[this.visibility](this.tasks)
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

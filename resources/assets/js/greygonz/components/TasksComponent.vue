<template>

    <tasks-list id="tasks-list"
        :filteredTasks="filteredTasks"
        :loading="loading"
        @toggle="changeCompletedTask"
        @reload="reloadTasks"
        @filter="setFilter">
    </tasks-list>

</template>


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

    import createApi from './tasks/api/tasks.js'
    import { loadavg } from 'os';

    const crud = createApi('/api/tasks');

    export default {
        data() {
            return {
                tasks: [],
                loading: true,
                filter: 'all'
            }
        },
        methods: {
            changeCompletedTask: function (task) {

                crud.update(task).then((response) => {
                    task.completed = !task.completed
                    //this.tasks[task.id-1] = task
                }).catch((error) => {
                    flash(error.message)
                })
            },
            reloadTasks: function () {
                
                this.loading = true;
                crud.getAll().then( (response) => {
                    this.tasks = response.data.data;
                }).catch((error) => {
                    flash(error.message); 
                }).then(() => {
                    this.loading = false;
                });
            },
            setFilter: function (filter) {
                this.filter = filter;
            }
        },
        computed: {
            filteredTasks() {
                return filters[this.filter](this.tasks)
            }
        },
        mounted() {
            this.loading = true;
            crud.getAll().then( (response) => {
                this.tasks = response.data.data;
            }).catch((error) => {
                flash(error.message); 
            }).then(() => {
                this.loading = false;
            });
        }
    }
</script>

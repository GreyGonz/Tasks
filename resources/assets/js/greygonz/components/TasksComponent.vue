<template>

    <tasks-list id="tasks-list"
        :filteredTasks="filteredTasks"
        :tasks="tasks"
        :loading="loading"
        :form="form"
        :adding="adding"
        @toggle="changeCompletedTask"
        @reload="reloadTasks"
        @filter="setFilter"
        @store-task="storeTask"
        @delete="deleteTask">
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
    import Form from 'acacha-forms'

    const crud = createApi('/api/tasks');

    export default {
        data() {
            return {
                tasks: [],
                loading: true,
                adding: false,
                filter: 'all',
                form: new Form({ user_id: '1', name: 'prova', description: '', completed: false })
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
            storeTask: function (form) {
                let url = '/api/tasks'

                // POST
                this.adding = true
                form.post(url).then((response) =>  {
                    // Emmagatzema a fitxer JSON
                    this.tasks.push({ name: form.name, description: form.description, user_id: form.user_id, completed: form.completed})
                    form.name=''
                    form.description=''
                }).catch((error) => {
                    flash(error.message)
                }).then( () => {
                    this.adding = false;
                })

                this.reloadTasks();
            },
            deleteTask: function (task) {

                crud.delete(task).then( (response) => {
                    this.reloadTasks();
                }).catch((error) => {
                    flash(error.message)
                })
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

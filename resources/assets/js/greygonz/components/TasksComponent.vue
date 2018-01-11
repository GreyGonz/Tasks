<template>

    <tasks-list :tasks="tasks" :loading="loading" @toggle="updateTask"></tasks-list>

</template>


<script>

    import axios from 'axios'
    import createApi from './tasks/api/tasks.js'

    const crud = createApi('/api/tasks');

    export default {
        data() {
            return {
                tasks: [],
                loading: true,
            }
        },
        // events: {
        //     toggle: function (task) {
        //         console.log('Yas')
        //         console.log(task)
        //     },
        // },
        methods: {
            updateTask: function (task) {

                crud.update(task).then((response) => {
                    task.completed = !task.completed
                    this.tasks[task.id-1] = task
                }).catch((error) => {
                    flash(error.message)
                })

            }
        },
        mounted() {
            crud.getAll().then((response) => {
                this.tasks = response.data.data
            }).catch((error) => {
                flash(error.message)
            }).then(() => {
                this.loading = false
            })
        }
    }
</script>

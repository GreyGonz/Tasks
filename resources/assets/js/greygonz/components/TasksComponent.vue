<template>

    <tasks-list :tasks="tasks" :loading="loading" @toggle="updateTask"></tasks-list>

</template>


<script>

    import createApi from './tasks/api/tasks.js'

    const crud = createApi('/api/tasks');

    export default {
        data() {
            return {
                tasks: [],
                loading: true,
            }
        },
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
            console.log('mounted');
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

<template>

    <tasks-list :tasks="tasks" :loading="loading"></tasks-list>

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
        events: {
            toggle: function (task) {
                console.log('Yas')
                console.log(task)
            },
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

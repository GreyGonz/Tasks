<template>
    <div>
        <tasks-list id="tasks-list"
            :filteredTasks="filteredTasks"
            :tasks="tasks"
            :loading="loading"
            :form="form"
            :formName="formName"
            :adding="adding"
            :taskNameToEditProp="taskNameToEditProp"
            @toggle="changeCompletedTask"
            @reload="reloadTasks"
            @editTaskName="setTaskNameToEdit"
            @filter="setFilter"
            @store-task="storeTask"
            @delete="deleteTask">
        </tasks-list>
        <message :msgtitle="messageTitle" :message="message" :type="messageType"></message>
    </div>
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
    import { setTimeout } from 'timers';

    const crud = createApi('/api/tasks');

    export default {
        data() {
            return {
                tasks: [],
                loading: true,
                adding: false,
                filter: 'all',
                component: null,
                form: new Form({ user_id: '1', name: 'prova', description: '', completed: false }),
                formName: new Form({ name: ''}),
                messageTitle: '',
                messageType: '',
                message: '',
                taskNameToEditProp: ''
            }
        },
        methods: {
            setTaskNameToEdit: function (taskName) {
                this.taskNameToEditProp = taskName;
            },
            triggerFlash: function (title, message, color) {
                this.messageTitle = title;
                this.messageType = color
                this.message = message;
                flash();
            },
            changeCompletedTask: function (task) {

                crud.update(task).then((response) => {
                    task.completed = !task.completed
                    //this.tasks[task.id-1] = task
                }).catch((error) => {
                    this.triggerFlash('Error', error.message, 'alert-dimiss')
                })
            },
            reloadTasks: function () {
                
                this.loading = true;
                crud.getAll().then( (response) => {
                  this.tasks = response.data.data;
                }).catch((error) => {
                    this.triggerFlash('Error', error.message, 'alert-dimiss') 
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
                    this.triggerFlash('Success', 'Task added successfully!', 'alert-success')
                }).catch((error) => {
                    this.triggerFlash('Error', error.message, 'alert-dimiss')
                }).then( () => {
                    this.adding = false;
                })

                this.reloadTasks();
            },
            deleteTask: function (task) {

                crud.delete(task).then( (response) => {
                    this.reloadTasks();
                }).catch((error) => {
                    this.triggerFlash('Error', error.message, 'alert-dimiss')
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
                this.triggerFlash('Error', error.message, 'alert-dimiss') 
            }).then(() => {
                this.loading = false;
            });
        }
    }
</script>

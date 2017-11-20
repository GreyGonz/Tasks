<template>
    <div>
        <widget :loading="loading">
            <p slot="title">Tasks:</p>

            <div v-cloak="" class="col-md-3">

                <ul>
                    <li v-for="task in filteredTasks" v-bind:class="{ completed: isCompleted(task) }" @dblclick="editTask(task)">
                        <input type="text" id="editingTask" v-model="editingTask" v-if="task == editedTask" @keydown.enter="updateTask(task)" @keydown.esc="discardUpdate(task)">
                        <div v-else>
                            {{task.name}}
                            <i class="fa fa-pencil" aria-hidden="true" @click="editTask(task)"></i>
                            <i v-if="taskBeenDeleted == task.id" class="fa fa-refresh fa-spin fa-lg"></i>
                            <i v-else="" class="fa fa-times" aria-hidden="true" @click="deleteTask(task)" ></i>


                        </div>
                    </li>
                </ul>

                <div class="form-group">
                    <label for="exampleInputEmail1">User:</label>
                    <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">-->
                    <users></users>
                </div>

                <div class="form-group">
                    <label for="newTask">Task name:</label>
                    <input type="text" class="form-control" id="newTask" v-model="newTask" @keydown.enter="addTask">
                </div>

                <button :disabled="creating" id="add" @click="addTask">
                    Add
                    <i class="fa fa-refresh fa-spin fa-lg" v-if="creating"></i>
                </button>

                <h2>Filtres</h2>
                <ul>
                    <li @click="show('all')" :class="{ active: this.filter === 'all' }">All</li>
                    <li @click="show('pending')" :class="{ active: this.filter === 'pending' }">Pending</li>
                    <li @click="show('completed')" :class="{ active: this.filter === 'completed' }">Completed</li>
                </ul>

                <p>Pending tasks: {{pendingTasksCounter}}</p>
                <!-- /.box-body -->
                <div class="box-footer"><slot name="footer">Footer here</slot></div>
            </div>

            <p slot="footer">Footer</p>
        </widget>

        <message title="Error" ></message>
    </div>

</template>

<style>
    [v-cloak] { display: none; }

    li.completed {
        text-decoration: line-through;
    }

    li.active {
        background-color: darkgray;
    }
</style>

<script>

    import Users from './Users'

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

    const LOCAL_STORAGE_KEY = 'TASKS';

    import { wait } from './utils.js';

    export default {
        components: { Users },
        data() {
            return {
                editedTask: null,
                newTask: '',
                editingTask: '',
                filter: 'all',
                tasks: [],
                creating: false,
                taskBeenDeleted: null
            }
        },
        watch: {
            tasks() {
//                localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(this.tasks));
            }
        },
        computed: {
            filteredTasks() {
                return filters[this.filter](this.tasks)
            },
            pendingTasksCounter() {
                return filters['pending'](this.tasks).length
            }
        },
        methods: {
            show(filter) {
                this.filter = filter
            },
            addTask() {
                this.creating = true
                // -- Crida metode PUT i emmagatzema a DB --
                let url = '/api/tasks'

                // POST
                axios.post(url, { name: this.newTask } ).then(() =>  {
                    console.log('New task added')
                    // Emmagatzema a fitxer JSON
                    this.tasks.push({name: this.newTask, completed: false})
                }).catch((error) => {
                    flash(error.message)
                }).then(() => {
                    this.$emit('loading', false)
                    this.newTask = ''
                    this.creating = false
                })
            },
            isCompleted(task) {
                return task.completed
            },
            deleteTask(task) {
                this.taskBeenDeleted = task.id

                let url = 'api/tasks/' + task.id

                axios.delete(url).then((response) => {
                    this.tasks.splice(this.tasks.indexOf(task), 1)
                }).catch((error) => {
                    flash(error.message)
                }).then(() => {
                    this.taskBeenDeleted = null
                })
            },
            editTask(task) {
                this.editedTask = task
                this.editingTask = task.name
            },
            updateTask(task) {
                task.name = this.editingTask
                this.editedTask = null
                this.editingTask = ''
            },
            discardUpdate(task) {
                this.editedTask = null
                this.editingTask = ''
            }
        },
        mounted() {

//            this.tasks = JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY) || '[]')
            console.log(this.tasks)

            // TODO Connectat a Internet i agafam la llista de tasques
//        this.tasks = ???
            // HTTP CLIENT
            let url = '/api/tasks'

            // -- Promises --
            // GET
            this.$emit('loading', true)
            axios.get(url).then((response) =>  {
                this.tasks = response.data;
            }).catch((error) => {
                flash(error.message)
            }).then(() => {
                this.$emit('loading', false)
            })
//        setTimeout( () => {
//          component.hide()
//        },3000)
            // API HTTP amb JSON <- Web service
            // URL GET http://NOM_SERVIDOR/api/task
            // URL POST http://NOM_SERVIDOR/api/task
            // URL DELETE http://NOM_SERVIDOR/api/task/{task}
            // URL PUT/PATCH http://NOM_SERVIDOR/api/task/{task}

        }
    }
</script>

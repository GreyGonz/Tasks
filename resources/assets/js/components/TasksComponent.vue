<template>
    <div v-cloak="" class="col-md-3">
        <ul>
            <li v-for="task in filteredTasks" v-bind:class="{ completed: isCompleted(task) }" @dblclick="editTask(task)">
                <input type="text" id="editingTask" v-model="editingTask" v-if="task == editedTask" @keydown.enter="updateTask(task)" @keydown.esc="discardUpdate(task)">
                <div v-else>
                    {{task.name}}
                    <i class="fa fa-pencil" aria-hidden="true" @click="editTask(task)"></i>
                    <i class="fa fa-times" aria-hidden="true" @click="deleteTask(task)"></i>
                </div>
            </li>
        </ul>
        New task: <input type="text" id="newTask" v-model="newTask" @keydown.enter="addTask">
        <button id="add" @click="addTask">Add</button>
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

    export default {
        data() {
            return {
                editedTask: null,
                newTask: '',
                editingTask: '',
                filter: 'all',
                tasks: []
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
                this.tasks.push({name: this.newTask, completed: false})
                this.newTask = ''
            },
            isCompleted(task) {
                return task.completed
            },
            deleteTask(task) {
                this.tasks.splice(this.tasks.indexOf(task), 1)
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

            var component = this

            //Promises
            this.$emit('loading', true)
            axios.get(url).then().then((response) =>  {
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

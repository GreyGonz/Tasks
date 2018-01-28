<template>
    <div>
        <div class="modal fade" id="modal-description">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Description</h4>
                    </div>
                    <div class="modal-body">
                        <quill-editor v-model="description" :options="editorOption"></quill-editor>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-show">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{ task.name }}</h4>
                    </div>
                    <div class="modal-body">
                        Go flex
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <widget :loading="loading" class="box">
            <p slot="title" class="box-title">Tasks</p>
            <div class="box-body">

                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Completed</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        <tr v-for="(task, index) in filteredTasks" :key="task.id">
                            <td>{{ index }}</td>
                            <td>{{ task.id }}</td>
                            <td>{{ task.name }}</td>
                            <td><toggle-button :value="task.completed" @change="sendEmit('toggle', task)"></toggle-button></td>
                            <td class="description" data-toggle="modal" data-target="#modal-description" @click="setDescription(task.description)">{{ task.description }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-show" @click="showTask(task)">Show</button>
                                    <button type="button" class="btn btn-xs btn-primary">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <!--<ul>-->
                    <!--<li v-for="task in filteredTasks" v-bind:class="{ completed: isCompleted(task) }" @dblclick="editTask(task)">-->
                        <!--<input type="text" id="editingTask" v-model="editingTask" v-if="task == editedTask" @keydown.enter="updateTask(task)" @keydown.esc="discardUpdate(task)">-->
                        <!--<div v-else>-->
                            <!--{{task.name}}-->
                            <!--<i class="fa fa-pencil" aria-hidden="true" @click="editTask(task)"></i>-->
                            <!--<i v-if="task.id == taskBeenDeleted" class="fa fa-refresh fa-spin fa-lg"></i>-->
                            <!--<i v-else="" class="fa fa-times" aria-hidden="true" @click="deleteTask(task)" ></i>-->


                        <!--</div>-->
                    <!--</li>-->
                <!--</ul>-->

                <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('user_id') }">
                    <label for="user_id">User:</label>
                    <transition name="fade">
                        <span v-text="form.errors.get('user_id')" v-if="form.errors.has('user_id')" class="help-block"></span>
                    </transition>
                    <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">-->
                    <users id="user_id" :value="form.user_id" @select="userSelected(form.user_id)"></users>
                </div>

                <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('name') }">
                    <label for="name">Task name:</label>
                    <transition name="fade">
                        <span v-text="form.errors.get('name')" v-if="form.errors.has('name')" class="help-block"></span>
                    </transition>
                    <input @input="form.errors.clear('name')" type="text" name="name" class="form-control" id="name" v-model="form.name" @keydown.enter="addTask">
                </div>

                <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('name') }">
                    <label for="name">Task description:</label>
                    <transition name="fade">
                        <span v-text="form.errors.get('description')" v-if="form.errors.has('description')" class="help-block"></span>
                    </transition>
                    <input @input="form.errors.clear('description')" type="text" name="description" class="form-control" id="description" v-model="form.description" @keydown.enter="addTask">
                </div>

                <h2>Filtres</h2>
                <div>
                    <button class="btn btn-primary" id="completed-tasks" @click="sendEmit('filter', 'completed')">
                        Completed
                    </button>
                    <button class="btn btn-primary" id="pending-tasks" @click="sendEmit('filter', 'pending')">
                        Pending
                    </button>
                    <button class="btn btn-primary" id="all-tasks" @click="sendEmit('filter', 'all')">
                        All
                    </button>
                </div>


            </div>

            <div slot="footer">
                {{filteredTasks.length}} tasks left
                <div class="box-footer">
                    <slot name="footer">
                        <button class="btn btn-primary" :disabled="form.submitting || form.errors.any()" id="store-task" @click="addTask">
                            <i class="fa fa-refresh fa-spin fa-lg" v-if="form.submitting"></i>
                            Add
                        </button>
                        <button class="btn btn-primary" id="reload" @click="sendEmit('reload', null)">
                            Reload
                        </button>
                    </slot>
                </div>
            </div>
        </widget>

        <message title="Error" message="" color="info"></message>
    </div>

</template>

<style src="quill/dist/quill.snow.css" />

<style>
    [v-cloak] { display: none; }

    li.completed {
        text-decoration: line-through;
    }

    li.active {
        background-color: darkgray;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity 3s ease;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .description {
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

</style>

<script>

    import Users from './Users'
    import Form from 'acacha-forms'
    import Quill from 'quill'
    import { vueQuill } from 'vue-quill-editor'

    

    const LOCAL_STORAGE_KEY = 'TASKS';

    import { wait } from './utils.js';
    import QuillEditor from "../../../../../node_modules/vue-quill-editor/src/editor.vue";

    export default {
        components: {
            QuillEditor,
            Users,
            vueQuill,
        },
        data() {
            return {
                editedTask: null,
                editingTask: '',
                task: '',
                creating: false,
                taskBeenDeleted: null,
                form: new Form({ user_id: '1', name: 'prova', description: '', completed: false }),
                description: "",
                editorOption: {
                    modules: {
                        toolbar: [
                            ['bold', 'italic'],
                            [{'list': 'ordered'}, {'list': 'bullet'}],
                            ['link'],
                        ],
                    }
                }
            }
        },
        props: {
            loading: {
                required: false,
            },
            filteredTasks: {
                type: Array,
                required: true,
            }
        },
        methods: {
            // BONS
            sendEmit(message, value) {
                this.$emit(message, value);
            },
            // FIN BONS
            toggleCompleted(message, task) {
                this.$emit(message, task)
            },
            showTask(task) {
                this.task = task;
            },
            setDescription(description) {
              this.description = description
            },
            userSelected(user) {
              this.form.user_id = user
            },
            show(filter) {
                this.filter = filter
            },
            addTask() {
                // -- Crida metode POST i emmagatzema a DB --
                let url = '/api/tasks'

                // POST
                this.form.post(url).then((response) =>  {
                    // Emmagatzema a fitxer JSON
                    this.filteredTasks.push({name: this.form.name, description: this.form.description, user_id: this.form.user_id, completed: this.form.completed})
                    this.form.name=''
                }).catch((error) => {
                    flash(error.message)
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
        }
    }
</script>

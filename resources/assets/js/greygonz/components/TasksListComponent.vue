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

        <div class="modal fade" id="modal-name">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit task name</h4>
                    </div>
                    <div class="modal-body">
                        <input id="task-name-edit" v-model="editingTask.name" name="taskNameEdit">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancel-button btn btn-default pull-left" data-dismiss="modal" @click="sendEmit('reload')">Close</button>
                        <button type="button" class="update-task btn btn-primary" @click="sendEmit('update', editingTask)" data-dismiss="modal">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-confirm-delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Are you shure to delete this task?</h4>
                    </div>
                    <div class="modal-body">
                        <h3 v-if="taskToDelete">Task {{ taskToDelete.name }}</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            id="cancel-delete"
                            class="btn btn-default pull-left" 
                            data-dismiss="modal" 
                            @click="sendEmit('reload')">
                            Cancel
                        </button>
                        <button type="button" 
                            id="destroy-task"
                            class="btn btn-primary"
                            @click="sendEmit('destroy')" 
                            data-dismiss="modal">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>


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
                            <td :id="'task-name-' + task.id"
                                data-toggle="modal"
                                data-target="#modal-name"
                                @click="sendEmit('editTask', task)">
                                {{ task.name }}
                            </td>
                            <td>
                                <toggle-button :value="task.completed" 
                                    @change="sendEmit('toggle', task)"
                                    :id="'task-toggle-' + task.id">
                                </toggle-button>
                            </td>
                            <td :id="'edit-task-desc-' + task.id" class="description" data-toggle="modal" data-target="#modal-description" @click="setDescription(task.description)">{{ task.description }}</td>
                            <td>
                                <div class="btn-group">
                                    <button :id="'delete-task-' + task.id" 
                                        type="button" 
                                        data-toggle="modal" 
                                        data-target="#modal-confirm-delete" 
                                        class="btn btn-xs btn-primary" 
                                        @click="sendEmit('delete', task)">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                    
                <div slot="footer">
                    <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('user_id') }">
                        <label for="user_id">User:</label>
                        <transition name="fade">
                            <span v-text="form.errors.get('user_id')" v-if="form.errors.has('user_id')" class="help-block"></span>
                        </transition>
                        <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">-->
                        <users :id="1" :value="form.user_id" @select="userSelected(form.user_id)"></users>
                    </div>

                    <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('name') }">
                        <label for="name">Task name:</label>
                        <transition name="fade">
                            <span v-text="form.errors.get('name')" v-if="form.errors.has('name')" class="help-block"></span>
                        </transition>
                        <input @input="form.errors.clear('name')" type="text" name="name" class="form-control" id="name" v-model="form.name" @keydown.enter="sendEmit('store-task', form)">
                    </div>

                    <div class="form-group has-feedback" :class="{ 'has-error': this.form.errors.has('name') }">
                        <label for="name">Task description:</label>
                        <transition name="fade">
                            <span v-text="form.errors.get('description')" v-if="form.errors.has('description')" class="help-block"></span>
                        </transition>
                        <input @input="form.errors.clear('description')" type="text" name="description" class="form-control" id="description" v-model="form.description" @keydown.enter="sendEmit('store-task', form)">
                    </div>

                    <div>
                        <button class="btn btn-primary" :disabled="form.submitting || form.errors.any()" id="store-task" @click="sendEmit('store-task', form)">
                            <i class="fa fa-refresh fa-spin fa-lg" v-if="adding"></i>
                            Add
                        </button>
                        <button class="btn btn-primary" id="reload" @click="sendEmit('reload', null)">
                            Reload
                        </button>
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

                    <div>
                        <span>{{ filteredTasks.length }} tasks left</span>
                    </div>
                </div>


            </div>

            
        </widget>
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
    import Quill from 'quill'
    import { vueQuill } from 'vue-quill-editor'

    

    const LOCAL_STORAGE_KEY = 'TASKS';

    import QuillEditor from "../../../../../node_modules/vue-quill-editor/src/editor.vue";

    export default {
        components: {
            QuillEditor,
            Users,
            vueQuill,
        },
        data() {
            return {
                editingTask: '',
                task: '',
                creating: false,
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
            tasks: {
                type: Array,
                required: true,
            },
            loading: {
                required: false,
            },
            filteredTasks: {
                type: Array,
                required: true,
            },
            form: {
                required: true
            },
            formName: {
                required: true
            },
            adding: {
                required: false
            },
            editingTaskProp: {
                required: true
            },
            taskToDelete: {
                required: true
            }
        },
        watch: {
            editingTaskProp: function (valor) {
                this.editingTask = valor;
            }
        },
        methods: {
            // BONS
            sendEmit(message, value) {
                this.$emit(message, value);
            },
            // FIN BONS
            /* showTask(task) {
                this.task = task;
            }, */
            /* setDescription(description) {
              this.description = description
            }, */
            userSelected(user) {
              this.form.user_id = user
            },
            /* isCompleted(task) {
                return task.completed
            }, */
            /* deleteTask(task) {
                this.taskBeenDeleted = task.id

                let url = 'api/tasks/' + task.id

                axios.delete(url).then((response) => {
                    this.tasks.splice(this.tasks.indexOf(task), 1)
                }).catch((error) => {
                    flash(error.message)
                }).then(() => {
                    this.taskBeenDeleted = null
                })
            }, */
            /* editTask(task) {
                this.editedTask = task
                this.editingTask = task.name
            }, */
            /* updateTask(task) {
                task.name = this.editingTask
                this.editedTask = null
                this.editingTask = ''
            },
            discardUpdate(task) {
                this.editedTask = null
                this.editingTask = ''
            } */
        }
    }
</script>

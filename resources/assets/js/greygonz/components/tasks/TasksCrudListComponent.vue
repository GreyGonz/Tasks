<template>
    <div class="box box-primary">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <i class="ion ion-clipboard"></i>

            <h3 class="box-title">Tasks</h3>

            <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <button id="reload" type="button" class="btn btn-default" @click="reloadEmit">Reload</button>
            <button id="all-tasks" type="button" class="btn btn-default" @click="changeVisibility('all')">All</button>
            <button id="completed-tasks" type="button" class="btn btn-default" @click="changeVisibility('completed')">Completed</button>
            <button id="pending-tasks" type="button" class="btn btn-default" @click="changeVisibility('pending')">Pending</button>
            <div class="overlay" v-if="loading">
                    <i class="fa fa-refresh fa-spin"></i>
            </div>
            <ul class="todo-list ui-sortable">
                <li v-for="(task, index) in filteredTasks" :key="index">
                    <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                    <input type="checkbox" value="">
                    <span class="text">{{ task.name }}</span>
                    <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
                <li v-if="adding">
                    <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                    <input type="checkbox" value="">
                    <span class="text">New Task</span>
                    <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>

            </ul>
        </div>
        <div class="box-footer clearfix no-border">
            <input type="textarea" name="name" />
            <button id="store-task" type="button" class="btn btn-default pull-right" @click="changeAdding(true)"><i class="fa fa-plus"></i> Add item</button>
            <span>{{ filteredTasks.length }} tasks left</span>
        </div>
    </div>
</template>

<style>

</style>

<script>
  export default {
    name: 'TasksCrudList',
    props: {
      tasks: {
        type: Array,
        required: true
      },
      filteredTasks: {
          type: Array,
          required: true,
      },          
      loading: Boolean,
      adding: Boolean
    },
    methods: {
        reloadEmit: function () {
            this.$emit('reload');
        },
        changeVisibility: function (visibilityValue) {
            this.$emit('visibility', visibilityValue)
        },
        changeAdding: function (addingValue) {
            this.$emit('adding', addingValue);
        }
    },
    mounted() {
        console.log(this.filteredTasks);
        
    }
  }

</script>

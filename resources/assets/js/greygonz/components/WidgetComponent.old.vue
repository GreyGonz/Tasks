<template>
    <div v-cloak="">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><slot name="title">Llista</slot></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <slot></slot>
                <div class="overlay" v-if="internalLoading">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"><slot name="footer">Footer here</slot></div>
        </div>
        <!-- /.box -->
    </div>

</template>

<style>

</style>

<script>

    export default {
        data() {
          return {
            internalLoading: this.loading
          }
        },
//        watch: {
//            loading(newValue) {
//                console.log('loading has changed')
//                this.internalLoading = newValue
//            }
//        },
        props: {
          loading: {
              required: false
          }
        },
        mounted() {
            console.log('widget muntat')
        }
    }
</script>

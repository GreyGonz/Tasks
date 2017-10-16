<template>
    <div class="alert alert-danger alert-dismissible" v-if="visible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> {{ titleData }}</h4>
        {{ messageData }}
    </div>
</template>

<style>

</style>

<script>


    export default {
        data() {
            return {
                messageData: this.message,
                titleData: this.title,
                visible: true
            }
        },
        method: {
            isVisible() {
                return this.visible;
            }
        },
        props: {
            'title': {
                required: false
            },
            'message': {
                required: true
            }
        },
        mounted() {
            console.log('mounted');
        }

    }
</script>

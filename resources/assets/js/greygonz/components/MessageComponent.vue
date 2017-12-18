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
                visible: false
            }
        },
        methods: {
            show() {
                this.visible = true
                var component = this
                setTimeout( () => {
                    component.hide()
                },30000)
            },
            hide(){
                this.visible = false
            }
        },
        props: {
            'title': {
                required: false
            },
            'message': {
                required: false
            }
        },
        mounted() {
            var component = this
            window.flash = function (message) {
                component.messageData = message
                component.show()
            }
        }

    }
</script>

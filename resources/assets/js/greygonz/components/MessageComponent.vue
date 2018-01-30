<template>
    <div id="message-box" :class="getMessageType()" v-if="visible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i :class="getIcon()"></i> {{ this.msgtitle }}</h4>
        {{ this.message }}
    </div>
</template>

<style>

</style>

<script>


    export default {
        data() {
            return {
                visible: false
            }
        },
        methods: {
            show() {
                console.log('message called')
                this.visible = true
                var component = this
                setTimeout( () => {
                    component.hide()
                },30000)
            },
            hide(){
                this.visible = false
            },
            getMessageType: function () {
                return "alert " + this.type + " alert-dimiss"
            },
            getIcon: function () {
                if(this.type == "alert-success") {
                    return "icon fa fa-check"
                } else {
                    return "icon fa fa-ban"
                }
            }
        },
        props: {
            'msgtitle': {
                required: false
            },
            'message': {
                required: false
            },
            'type': {
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

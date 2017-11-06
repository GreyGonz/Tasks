<template>
    <div>
        <widget :loading="loading">
            <p slot="title">Tasks:</p>
            <tasks @loading="load"></tasks>
            <p slot="footer">Footer</p>
        </widget>

        <message title="Error" ></message>
    </div>
</template>

<style>

</style>

<script>
    export default {
        data() {
            return {
                loading: false
            }
        },
        methods: {
            load(load) {
                console.log(load)
                this.loading = load
            }
        },
        mounted() {
            console.log('mounted tasks views')
        }
    }
</script>
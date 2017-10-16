<template>
    <div>
        <widget>
            <p slot="title">Tasks:</p>
            <tasks ></tasks>
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

            }
        },
        mounted() {
            console.log('mounted tasks views')
        }
    }
</script>
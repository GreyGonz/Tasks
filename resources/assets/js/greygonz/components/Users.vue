<template>
    <div>
        <multiselect @select="select(this.user)" :value="value" :id="id" :name="name" v-model="user" :options="users" :custom-label="customLabel"></multiselect>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css">

</style>

<script>

    import axios from 'axios'
    import Multiselect from 'vue-multiselect'

    export default {
        components: { Multiselect },
        name: 'User',
        data() {
            return {
//                numUsers: 0,
                user: null,
                users: [],
                value: this.getValue
            }
        },
        props: ['id', 'name'],
        computed: {
          numUsers() {
              return this.users.length
          },
        },
        watch: {
            value(newValue) {
                this.user = this.userObject(newValue);
            }
        },
        methods: {
            userObject(id) {
                return this.users.find( user => {
                    return user.id == id;
                })
            },
            customLabel({ name, email}) {
                return `${name} - ${email}`
            },
            select(user) {
                console.log(this.getValue())
                this.$emit('select', user)
            },
            getValue() {
                //user = this.users[0];
                //this.value = `${user.name} - ${user.email}`;
                return "Hola";
            }
        },
        mounted() {
            axios.get('api/v1/users').then(response => {
                this.users = response.data;
                this.user = this.userObject(this.id)
//                this.user = this.users.find( user => {
//                    return user.id == this.value
//                });
            }).catch(error => {
                console.log(error);
            }).then()
        }
    }
</script>
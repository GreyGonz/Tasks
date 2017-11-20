<template>
    <div>
        <multiselect :id="id" v-model="user" :options="users" :custom-label="customLabel"></multiselect>
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
                users: []
            }
        },
        props: ['id'],
        computed: {
          numUsers() {
              return this.users.length
          },
        },
        methods: {
          customLabel({ name, email}) {
              return `${name} - ${email}`
          }
        },
        mounted() {
            console.log('Mounted ok')

            axios.get('api/v1/users').then( response => {
                this.users = response.data;
            }).catch( error => {
                console.log(error);
            }).then()

//            this.users = [
//                {
//                    id: 1,
//                    name: 'Perropolesia',
//                    email: 'adfas@adfsafd.com'
//
//                },
//                {
//                    id: 2,
//                    name: 'Perropolesia2',
//                    email: 'adfas2@adfsafd.com'
//
//                },
//                {
//                    id: 3,
//                    name: 'Perropolesia3',
//                    email: 'adfas3@adfsafd.com'
//
//                }
//            ]

//            console.log(numUsers);
        }
    }
</script>
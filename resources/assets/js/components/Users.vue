<template>
    <div>
        Users ({{numUsers}}):
        <select>
            <option :value="user.id" v-for="user in users"> {{user.name}} - {{user.email}} </option>
        </select>
    </div>
</template>

<style>
</style>

<script>

    import axios from 'axios'

    export default {
        name: 'name',
        data() {
            return {
//                numUsers: 0,
                users: []
            }
        },
        computed: {
          numUsers() {
              return this.users.length
          },
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
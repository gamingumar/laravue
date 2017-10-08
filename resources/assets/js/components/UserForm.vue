<script>
    import axios from 'axios';

    class Errors {
        constructor() {
            this.errors = {};
        }

        has(field) {
            return this.errors.hasOwnProperty(field);
        }

        get(field) {
            if(this.errors[field]){
                return this.errors[field][0];
            }
        }
        record(errors) {
            console.log('recording', errors);
            this.errors = errors.errors;
        }
        any() {
            return Object.keys(this.errors).length > 0;
        }
        clear(field) {
            delete this.errors[field];
        }
    }

    export default {
        data() {
            return {
                errors: new Errors(),
                name: 'umar'
            }
        },
        methods: {
            getSkills() {
                axios.get('/skills')
                    .then(response => console.log(response.data))
                    .catch(error => console.log(this.errors.record(error)));

            },
            createUser() {
                let data ={
                    name: this.name
                };
                axios.post('/create', data)
                    .then(response => this.onSuccess(response))
                    .catch(error => console.log(this.errors.record(error.response.data)));
            },
            onSuccess(response) {
                alert(response.data.message);
                this.name = '';
            }
        },
        mounted() {
            console.log('User Form Component mounted.')
        }
    }




</script>

<template>
    <div id="form">
        <h1>user {{name}} form vue component </h1>
        <input title="name" type="text" v-model="name" />
        <button v-on:click="getSkills">Get Skills</button>

        <button v-on:click="createUser">Create User</button>



        <form class="form-horizontal" method="POST"
              @keydown="errors.clear($event.target.name)"
              action="/create" @submit.prevent="createUser">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text"
                           v-model="name"
                           class="form-control" name="name" autofocus>

                    <span class="help-block" v-if="errors.has('name')">
                                        <strong v-text="errors.get('name')"></strong>
                                    </span>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" :disabled="errors.any()" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>

        </form>



    </div>
</template>
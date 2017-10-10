<template>
    <div id="form">
        <form class="form-horizontal" method="POST"
              @keydown="errors.clear($event.target.name)"
              enctype="multipart/form-data"
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

            <!-- phone -->
            <div class="form-group">
                <label for="phone" class="col-md-4 control-label">Phone</label>

                <div class="col-md-6">
                    <input id="phone" type="text"
                           v-model="phone"
                           class="form-control" name="phone">

                    <span class="help-block" v-if="errors.has('phone')">
                        <strong v-text="errors.get('phone')"></strong>
                    </span>
                </div>
            </div>

            <!-- email -->
            <div class="form-group">
                <label for="email" class="col-md-4 control-label">Email</label>

                <div class="col-md-6">
                    <input id="email" type="text"
                           v-model="email"
                           class="form-control" name="email">

                    <span class="help-block" v-if="errors.has('email')">
                        <strong v-text="errors.get('email')"></strong>
                    </span>
                </div>
            </div>

            <!-- gender -->
            <div class="form-group">
                <label for="gender" class="col-md-4 control-label">Gender</label>

                <div class="col-md-6">
                    <!--<input id="gender" type="text"-->
                           <!--v-model="gender"-->
                           <!--class="form-control" name="gender">-->

                    <div class="radio">
                        <label><input
                                type="radio" @click="errors.clear('gender')"
                                v-model="gender" name="gender" value="Male">Male</label>
                    </div>
                    <div class="radio">
                        <label><input @click="errors.clear('gender')"
                                type="radio" v-model="gender"
                                name="gender" value="Female">Female</label>
                    </div>

                    <span class="help-block" v-if="errors.has('gender')">
                        <strong v-text="errors.get('gender')"></strong>
                    </span>
                </div>
            </div>

            <!-- date of birth -->
            <div class="form-group">
                <label for="dob" class="col-md-4 control-label">Date of Birth</label>

                <div class="col-md-6">
                    <input id="dob" type="text"
                           v-model="dob"
                           class="form-control" name="dob">

                    <span class="help-block" v-if="errors.has('dob')">
                        <strong v-text="errors.get('dob')"></strong>
                    </span>
                </div>
            </div>

            <!-- biography -->
            <div class="form-group">
                <label for="biography" class="col-md-4 control-label">Biography</label>

                <div class="col-md-6">
                    <input id="biography" type="text"
                           v-model="biography"
                           class="form-control" name="biography">

                    <span class="help-block" v-if="errors.has('biography')">
                        <strong v-text="errors.get('biography')"></strong>
                    </span>
                </div>
            </div>

            <!-- image file -->
            <div class="form-group">
                <label for="image" class="col-md-4 control-label">Image</label>

                <div class="col-md-6">
                    <p>selected file is: {{image.name}}</p>

                    <input type="file"
                           id="image"
                           name="image"
                           accept="image/*"
                           @change="imageChange($event)"
                           class="input-file" />

                    <span class="help-block" v-if="errors.has('image')">
                        <strong v-text="errors.get('image')"></strong>
                    </span>
                </div>
            </div>

            <input id="password" type="hidden"
                   v-model="password" value=""
                   name="password">

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

<script>
    import axios from 'axios';
    import _ from 'lodash';
    import router from '../routes';

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
                name: 'Umar Aamer',
                phone: '1234567890123',
                email: 'umaraamer@gmail.com',
                gender: '',
                dob: '22-March-1994',
                biography: 'nothing..',
                image: '',
                password: '123',
            }
        },
        methods: {
            createUser() {
//                let data ={
//                    name: this.name,
//                    phone: this.phone,
//                    email: this.email,
//                    gender: this.gender,
//                    dob: this.dob,
//                    biography: this.biography,
//                    image: this.image,
//                    password: this.password,
//                };
                let formData = new FormData();
//                _.values(data).map(item => {
//                    console.log('doinnnn', item);
//                });
//                formData.append('data', data);
//                formData = data;
                formData.append('name', this.name);
                formData.append('phone', this.phone);
                formData.append('email', this.email);
                formData.append('gender', this.gender);
                formData.append('dob', this.dob);
                formData.append('biography', this.biography);
                formData.append('image', this.image);
                formData.append('password', this.password);


                console.log('sending data: ', formData);
                axios.post('/users', formData, {headers: {'Content-Type': 'multipart/form-data'}})
                    .then(response => this.onSuccess(response))
                    .catch(error => console.log(this.errors.record(error.response.data)));
            },
            onSuccess(response) {
                console.log('success', response);
                alert(response.data.message);
                router.push({ name: 'view', params: { user_id: response.data.user_id }});
                this.name = '';
            },
            imageChange(event) {
                if (event.target.files.length) {
                    this.errors.clear('image');
                    this.image = event.target.files[0];
                    console.log('got files', this.image);
                } else {
                    console.log('no file selected');
                }
            }
        },
        mounted() {
            console.log('Create page Component mounted.')
        }
    }
</script>


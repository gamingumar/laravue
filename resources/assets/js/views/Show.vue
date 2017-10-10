<template>
    <div>
        <h4>User Details:</h4>

        <ul>
            <li>Name: {{user.name}}</li>
            <li>phone: {{user.phone}}</li>
            <li>email: {{user.email}}</li>
            <li>gender: {{user.gender}}</li>
            <li>dob: {{user.dob}}</li>
            <li>biography: {{user.biography}}</li>
            <li>image: <img :src="user.image" style="width: 480px; height: 240px" /></li>
        </ul>

    </div>

</template>

<script>
    import axios from 'axios';
    import router from '../routes';

    export default {
        data() {
            return {
                user: {}
            }
        },
        methods: {
            onSuccess({data}) {
//            alert(response.data.message);
                data.user.image = "data:image/jpeg;base64," + data.user.image;
                this.user = data.user;
                console.log('from success: ', this.user);
            }
        },
        mounted() {
            //fetch the user
            console.log('ABC Show Component mounted.');

            axios.get(`/users/${this.$route.params.user_id}`)
                .then(response => this.onSuccess(response))
                .catch(error => console.log(error.response));
        }

    }
</script>


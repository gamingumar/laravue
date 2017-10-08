<template>

</template>

<script>
    import axios from 'axios';
    import router from '../routes';

    export default {
        data() {
            return {
                name: 'umar'
            }
        },
        methods: {

        },
        mounted() {
            //fetch the user
            console.log('User Form Component mounted.');

            axios.get(`/users/${this.$route.params.user_id}`)
                .then(response => this.onSuccess(response))
                .catch(error => console.log(error.response));
        },
        onSuccess(response) {
            alert(response.data.message);
            console.log(response);
        }
    }
</script>


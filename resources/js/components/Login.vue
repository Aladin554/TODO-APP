<template>
    <div class="container">
        <h2>Login</h2>
        <form @submit.prevent="login">
            <div>
                <label>Email</label>
                <input v-model="form.email" type="email" required />
            </div>
            <div>
                <label>Password</label>
                <input v-model="form.password" type="password" required />
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: { email: '', password: '' },
        };
    },
    methods: {
        async login() {
            try {
                const response = await axios.post('/login', this.form);
                localStorage.setItem('token', response.data.token);
                axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
                this.$router.push('/');
            } catch (error) {
                alert('Login failed');
            }
        },
    },
};
</script>
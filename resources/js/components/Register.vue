<template>
    <div class="container">
        <h2>Register</h2>
        <form @submit.prevent="register">
            <div>
                <label>Name</label>
                <input v-model="form.name" type="text" required />
            </div>
            <div>
                <label>Email</label>
                <input v-model="form.email" type="email" required />
            </div>
            <div>
                <label>Password</label>
                <input v-model="form.password" type="password" required />
            </div>
            <div>
                <label>Confirm Password</label>
                <input v-model="form.password_confirmation" type="password" required />
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: { name: '', email: '', password: '', password_confirmation: '' },
        };
    },
    methods: {
        async register() {
            try {
                const response = await axios.post('/register', this.form);
                localStorage.setItem('token', response.data.token);
                axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
                this.$router.push('/');
            } catch (error) {
                alert('Registration failed');
            }
        },
    },
};
</script>
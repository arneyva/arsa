<template>
    <div>
      <h1>Login</h1>
      <form @submit.prevent="login">
        <div>
          <label for="email">Email:</label>
          <input type="email" v-model="email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" v-model="password" required />
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
        email: '',
        password: ''
      };
    },
    methods: {
      async login() {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/login', {
            email: this.email,
            password: this.password
          });
          localStorage.setItem('token', response.data.token); // Menyimpan token
          this.$router.push('/tasks'); // Setelah login berhasil, arahkan ke halaman tasks
        } catch (error) {
          console.error('Login failed:', error);
        }
      }
    }
  };
  </script>
  
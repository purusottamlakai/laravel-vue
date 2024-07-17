<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="w-full max-w-sm p-6 bg-white rounded-md shadow-md">
        <h1 class="mb-6 text-2xl font-bold text-center text-gray-700">Login</h1>
        <form @submit.prevent="handleLogin" class="space-y-4">
          <div>
            <input
              v-model="email"
              type="email"
              placeholder="Email"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
            />
          </div>
          <div>
            <input
              v-model="password"
              type="password"
              placeholder="Password"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
            />
          </div>
          <div>
            <button
              type="submit"
              class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
              Login
            </button>
          </div>
        </form>
        <p v-if="errorMessage" class="pt-4 text-center text-red-500">{{ errorMessage }}</p>
      </div>
    </div>
  </template>
  
  <script>
  import { mapActions } from 'vuex';
  
  export default {
    data() {
      return {
        email: '',
        password: '',
        errorMessage: ''
      };
    },
    methods: {
      ...mapActions(['login']),
      async handleLogin() {
        try {
          await this.login({ email: this.email, password: this.password });
          this.$router.push('/home');
        } catch (error) {
          this.errorMessage = 'Error logging in. Please try again.';
          console.error('Error logging in:', error);
        }
      }
    }
  };
  </script>  
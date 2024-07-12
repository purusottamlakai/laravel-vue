<template>
  <div class="navbar">
    <div class="logo">Dashboard</div>
    <div class="links">
      <router-link v-if="!isAuthenticated" to="/login" :change_auth="checkAuthStatus">Login</router-link>
      <router-link v-if="isAuthenticated" to="/home">Home</router-link>
      <router-link v-if="isAuthenticated" to="/users">Users</router-link>
      <router-link v-if="isAuthenticated" to="/products">Products</router-link>
      <router-link v-if="isAuthenticated" to="/logout" @click.prevent="logout">Logout</router-link>
    </div>
  </div>
  <div class="content">
    <router-view></router-view>
  </div>
</template>


<script>
  import axios from 'axios';

  export default {
    data() {
      return {
        isAuthenticated: false,
      };
    },
    methods: {
      async checkAuthStatus() {
          const token = localStorage.getItem('token');
          this.isAuthenticated = !!token;
      },
      async logout() {
        try {
          await axios.post('/api/logout');
          localStorage.removeItem('token');
          this.isAuthenticated = false;
          this.$router.push('/login');
        } catch (error) {
          console.error("Error logging out:", error);
        }
      },
    },
    created() {
      this.checkAuthStatus();
    }
  };
</script>

<style>
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
  }

  .logo {
    font-size: 24px;
  }
  .links {
    display: flex;
  }

  .links > * {
    margin-right: 20px;
  }

  .links > *:last-child {
    margin-right: 0;
  }

  .router-link-exact-active {
    font-weight: bold;
    text-decoration: underline;
  }

  .content {
    padding: 20px;
  }
</style>
  
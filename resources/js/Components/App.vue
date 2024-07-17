<template>
  <div class="navbar">
    <div class="logo">Dashboard</div>
    <div class="links">
      <router-link v-if="!isAuthenticated" to="/login">Login</router-link>
      <router-link v-if="isAuthenticated" to="/home">Home</router-link>
      <router-link v-if="isAuthenticated" to="/users">Users</router-link>
      <router-link v-if="isAuthenticated" to="/products">Products</router-link>
      <a  v-if="isAuthenticated" @click.prevent="logout">Logout</a>
    </div>
  </div>
  <div class="content">
    <router-view></router-view>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  computed: {
    ...mapState(['isAuthenticated']),
  },
  methods: {
    ...mapActions(['logout']),
  },
  created() {
    this.$store.dispatch('checkAuthStatus');
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
  
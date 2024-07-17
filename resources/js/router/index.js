import { createRouter, createWebHistory } from 'vue-router';
import axios from 'axios';

import HomeComponent from '../Components/Home.vue';
import ProductsComponent from '../Components/Products/ProductList.vue';
import UserListComponent from '../Components/Users/UserList.vue';
import LoginComponent from '../Components/Login.vue';

const routes = [
    { path: '/home', component: HomeComponent },
    { path: '/products', component: ProductsComponent, meta: { requiresAuth: true } },
    { path: '/users', component: UserListComponent, meta: { requiresAuth: true } },
    { path: '/login', component: LoginComponent },
    { path: '/', redirect: '/home' }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach(async (to, from, next) => {
    const token = localStorage.getItem('token');

    if (!token && to.path !== '/login') {
        next('/login');
    } else if (token) {
        try {
            await axios.get('/api/user');
            next();
        } catch (error) {
            localStorage.removeItem('token');
            next('/login');
        }
    } else {
        next();
    }
});

export default router;

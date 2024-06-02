import { createRouter, createWebHistory }  from 'vue-router';

import HomeComponent from '../Components/Home.vue';
import ProductsComponent from '../Components/Products/ProductList.vue';
import UserListComponent from '../Components/Users/UserList.vue';


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component:HomeComponent
        },
        {
            path: '/products',
            component: ProductsComponent
        },
        {
            path: '/users',
            component: UserListComponent
        }
    ]
});

export default router;
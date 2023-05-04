import { createRouter, createWebHistory } from "vue-router";
import Dashboard from '../views/Dashboard.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Default from '../components/Default.vue'
import store from '../store'

const routes = [
    {
        path: '/',
        name: 'Login',
        meta: {isGuest: true},
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        meta: {isGuest: true},
        component: Register
    },
    {
        component: Default,
        name: 'Default',
        meta: {requiresAuth: true},
        children: [
            {
                path: '/dashboard',
                name: 'Dashboard',
                component: Dashboard
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.token) {
        next({name: 'Login'});
    }
    else if (store.state.token && (to.meta.isGuest === true)) {
        next({name: 'Dashboard'});
    }
    else {
        next();
    }
})

export default router;
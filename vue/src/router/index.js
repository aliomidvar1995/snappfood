import { createRouter, createWebHistory } from "vue-router";
import Profile from '../views/Profile.vue'
import EditProfile from '../views/EditProfile.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Default from '../components/Default.vue'
import CreateAddress from '../views/CreateAddress.vue'
import Addresses from '../views/Addresses.vue'
import Restaurants from '../views/Restaurants.vue'
import NearRestaurants from '../views/NearRestaurats.vue'
import Foods from '../views/Foods.vue'
import Carts from '../views/Carts.vue'
import Cart from '../views/Cart.vue'
import Comments from '../views/Comments.vue'
import Comment from '../views/Comment.vue'
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
        path: '/',
        component: Default,
        name: 'Default',
        meta: {requiresAuth: true},
        children: [
            {
                path: '/profile',
                name: 'Profile',
                component: Profile
            },
            {
                path: '/profile/edit',
                name: 'EditProfile',
                component: EditProfile
            },
            {
                path: '/profile/addresses/create',
                name: 'CreateAddress',
                component: CreateAddress
            },
            {
                path: '/profile/addresses',
                name: 'Addresses',
                component: Addresses
            },
            {
                path: '/restaurants',
                name: 'Restaurants',
                component: Restaurants
            },
            {
                path: '/near-restaurants',
                name: 'NearRestaurants',
                component: NearRestaurants
            },
            {
                path: '/restaurants/:restaurant_id/foods',
                name: 'Foods',
                component: Foods,
                props: true
            },
            {
                path: '/carts',
                name: 'Carts',
                component: Carts
            },
            {
                path: '/carts/:cart_id',
                name: 'Cart',
                component: Cart,
                props: true
            },
            {
                path: '/comments',
                name: 'Comments',
                component: Comments
            },
            {
                path: '/comments/:cart_id',
                name: 'Comment',
                component: Comment,
                props: true
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        next({name: 'Login'});
    }
    else if (localStorage.getItem('token') && (to.meta.isGuest === true)) {
        next({name: 'Profile'});
    }
    else {
        next();
    }
})

export default router;
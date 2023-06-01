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

const routes = [
    {
        path: '/',
        name: 'Login',
        meta: {isGuest: true, title: 'ورود'},
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        meta: {isGuest: true, title: 'ثبت نام'},
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
                component: Profile,
                meta: {title: 'پروفایل'}
            },
            {
                path: '/profile/edit',
                name: 'EditProfile',
                component: EditProfile,
                meta: {title: 'ویرایش پروفایل'}
            },
            {
                path: '/profile/addresses/create',
                name: 'CreateAddress',
                component: CreateAddress,
                meta: {title: 'انتخاب آدرس'}
            },
            {
                path: '/profile/addresses',
                name: 'Addresses',
                component: Addresses,
                meta: {title: 'آدرس ها'}
            },
            {
                path: '/restaurants',
                name: 'Restaurants',
                component: Restaurants,
                meta: {title: 'رستوران ها'}
            },
            {
                path: '/near-restaurants',
                name: 'NearRestaurants',
                component: NearRestaurants,
                meta: {title: 'رستوران های نزدیک'}
            },
            {
                path: '/restaurants/:restaurant_id/foods',
                name: 'Foods',
                component: Foods,
                props: true,
                meta: {title: 'غذا ها'}
            },
            {
                path: '/carts',
                name: 'Carts',
                component: Carts,
                meta: {title: 'کارت ها'}
            },
            {
                path: '/carts/:cart_id',
                name: 'Cart',
                component: Cart,
                props: true,
                meta: {title: 'کارت'}
            },
            {
                path: '/comments',
                name: 'Comments',
                component: Comments,
                meta: {title: 'نظرات'}
            },
            {
                path: '/comments/:cart_id',
                name: 'Comment',
                component: Comment,
                props: true,
                meta: {title: 'نظر و پاسخ'}
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
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
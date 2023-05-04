<template>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <teleport to='title'>register</teleport>
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign up for free</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form @submit="register" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" v-model="user.name"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <p class="text-red-500">{{ nameError }}</p>
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" v-model="user.email"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <p class="text-red-500">{{ emailError }}</p>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" v-model="user.password"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <p class="text-red-500">{{ passwordError }}</p>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Password Confirmation</label>
                    </div>
                    <div class="mt-2">
                        <input id="password_confirmation" name="password_confirmation" type="password" v-model="user.password_confirmation"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <p class="text-red-500">{{ passwordConfirmationError }}</p>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        up</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Already registered?
                <router-link :to="{name: 'Login'}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500 cursor-pointer">Login now</router-link>
            </p>
        </div>
        <p>{{ user.name }}</p>
    </div>
</template>

<script setup>
    import {useRouter} from 'vue-router'
    import store from '../store'
    import { ref } from 'vue';
    import axiosClient from '../axios'
    const router = useRouter();
    const user = {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    }

    let nameError = ref();
    let emailError = ref();
    let passwordError = ref();
    let passwordConfirmationError = ref();

    function register(e) {
        e.preventDefault();
        axiosClient.post('/register', user)
        .then(({data}) => {
            store.state.user = data.user;
            store.state.token = data.token;
            sessionStorage.setItem('TOKEN', data.token)
            router.push({name: 'Dashboard'});
            return data;
        })
        .catch((error) => {
            nameError.value = error.response.data.errors.name[0]
            emailError.value = error.response.data.errors.email[0]
            passwordError.value = error.response.data.errors.password[0]
            passwordConfirmationError.value = error.response.data.errors.password_confirmation[0]
        })

    }
</script>
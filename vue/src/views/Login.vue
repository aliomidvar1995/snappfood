<template>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <teleport to="title">login</teleport>
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form @submit="login" class="space-y-6">
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
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        in</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member?
                <router-link :to="{name: 'Register'}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500 cursor-pointer">Register now</router-link>
            </p>
        </div>
    </div>
</template>

<script setup>
import store from '../store';
import { useRouter } from 'vue-router';
import axiosClient from '../axios';
import {ref} from 'vue'

const router = useRouter();

const user = {
    email: '',
    password: ''
}

let emailError = ref()
let passwordError = ref()

function login(e) {
    e.preventDefault();
    axiosClient.post('/login', user)
    .then(({data}) => {
        store.state.user = data.user;
        store.state.token = data.token;
        sessionStorage.setItem('TOKEN', data.token)
        router.push({name: 'Dashboard'});
        return data;
    })
    .catch((err) => {
        emailError.value = err.response.data.errors.email[0]
        passwordError.value = err.response.data.errors.password[0]
    })
}
</script>
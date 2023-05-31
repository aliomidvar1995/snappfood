<template>
    <div class="mx-auto w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" @submit.prevent="edit">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">ویرایش پروفایل</h5>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام</label>
                <input type="text" name="name" id="name" v-model="user.name"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                <p class="text-red-500">{{ nameError }}</p>
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ایمیل</label>
                <input type="email" name="email" id="email" v-model="user.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                <p class="text-red-500">{{ emailError }}</p>
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">پسورد</label>
                <input type="password" name="password" id="password" v-model="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                <p class="text-red-500">{{ passwordError }}</p>
            </div>
            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تایید رمز عبور</label>
                <input type="password" name="password_confirmation" v-model="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                <p class="text-red-500">{{ passwordConfirmationError }}</p>
            </div>
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ویرایش</button>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import axiosClient from "../axios";

const router = useRouter()

const user = ref(JSON.parse(localStorage.getItem('user')))

let nameError = ref();
let emailError = ref();
let passwordError = ref();
let passwordConfirmationError = ref();

let password = ref('')
let password_confirmation = ref('')

function edit() {
    axiosClient.put(`/register`, {name: user.value.name, email: user.value.email, password: password.value, password_confirmation: password_confirmation.value})
    .then((res) => {
        localStorage.setItem('user', JSON.stringify(res.data.user))
        router.push({name: 'Profile'})
    })
    .catch((err) => {
        nameError.value = err.response.data.errors.name[0]
        emailError.value = err.response.data.errors.email[0]
        passwordError.value = err.response.data.errors.password[0]
        passwordConfirmationError.value = err.response.data.errors.password_confirmation[0]
    })
}
</script>

<style>

</style>
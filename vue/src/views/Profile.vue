<script setup>
import { onMounted, ref } from "vue";
import { onBeforeRouteUpdate } from "vue-router";
import axiosClient from "../axios";
import store from "../store";

const user = ref({
    name: "",
    email: "",
});

user.value.name = JSON.parse(localStorage.getItem("user")).name;
user.value.email = JSON.parse(localStorage.getItem("user")).email;

// axiosClient.get(`/profile`)
// .then((res) => {
//     user.value.name = res.data.name;
//     user.value.email = res.data.email;
// })
</script>

<template>
    <!-- <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                پروفایل
            </h1>
        </div>
    </header> -->
    
    <div class="flex justify-center">
        <div class="overflow-hidden max-w-sm bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="text-center text-white p-6 bg-slate-600 mb-2 text-2xl font-bold tracking-tight dark:text-white">{{ user.name }}</h5>
            <p class="font-normal p-6 text-gray-700 dark:text-gray-400">{{ user.email }}</p>
        </div>
    </div>

</template>

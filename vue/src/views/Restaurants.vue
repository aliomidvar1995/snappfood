<template>
    <div v-if="loading" class="flex justify-center items-center">
        <Loading />
    </div>
    <div v-else class="flex justify-center flex-col items-center">
        <div v-for="restaurant in restaurants.data" :key="restaurant.id">
            <div class="w-fit bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <img class="rounded-t-lg" :src="restaurant.image" alt="" width="300" />
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ restaurant.name }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"></p>
                    <router-link :to="{name: 'Foods', params: {restaurant_id: restaurant.id} }" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        غذا ها
                    </router-link>
                </div>
            </div>
        </div>
        <TailwindPagination
            class="mt-3"
            dir="ltr"
            :data="restaurants"
            @pagination-change-page="getResults"
        />
    </div>
</template>

<script setup>
import Loading from '../components/Loading.vue'
import { ref } from "vue";
import { TailwindPagination } from "laravel-vue-pagination";
import axiosClient from "../axios";

const restaurants = ref([]);

const loading = ref(true)

const getResults = (page = 1) => {
    axiosClient.get(`/customer/restaurants?page=${page}`)
    .then((res) => {
        console.log(res.data);
        restaurants.value = res.data
        loading.value = false
    })
};

getResults();
</script>

<style>
</style>

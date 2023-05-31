<template>
    <div class="flex justify-center items-center" v-if="loading">
        <Loading />
    </div>
    <div class="w-1/2 mx-auto grid sm:grid-cols-2 place-items-center gap-3" v-else>
        <div v-for="restaurant in nearRestaurants" :key="restaurant.id">
            <div class="w-fit min-w-fit bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
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
    </div>
</template>

<script setup>
import { ref } from "vue";
import axiosClient from "../axios";
import Loading from '../components/Loading.vue'


const nearRestaurants = ref([])

const loading = ref(true)

function getNearRestaurants() {
    axiosClient.get(`/customer/nearest-restaurants`)
    .then((res) => {
        console.log(res.data.restaurants);
        nearRestaurants.value = res.data.restaurants;
        loading.value = false
    })
}

getNearRestaurants()

</script>

<style>

</style>
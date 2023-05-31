<template>
    <div v-if="loading" class="flex justify-center items-center">
        <Loading />
    </div>
    <div v-else class="flex justify-center flex-col items-center">
        <div v-for="food in foods.data" :key="food.id">
            <div class="w-fit bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <img class="rounded-t-lg" :src="food.image" alt="" width="300" />
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ food.name }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">قیمت غذا: {{ food.food_party_price }}</p>
                    <svg @click="increase" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-plus-fill inline-block cursor-pointer" viewBox="0 0 16 16">
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                    <span class="mx-5">
                        {{ count }}
                    </span>
                    <svg @click="decrease" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-dash-fill inline-block cursor-pointer" viewBox="0 0 16 16">
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/>
                    </svg>
                    <br>
                    <button @click="cart(food.id)" class="cursor-pointer inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">افزودن</button>
                </div>
            </div>
        </div>
        <TailwindPagination
            class="mt-3"
            dir="ltr"
            :data="foods"
            @pagination-change-page="getFoods"
        />
    </div>
</template>

<script setup>
import { TailwindPagination } from "laravel-vue-pagination";
import Loading from '../components/Loading.vue'
import { onMounted, ref } from "vue"
import axiosClient from "../axios"

const props = defineProps(['restaurant_id'])

const foods = ref([])

const count = ref(0)

const loading = ref(true)

const getFoods = (page = 1) => {
    axiosClient.get(`/customer/restaurants/${props.restaurant_id}/foods?page=${page}`)
    .then((res) => {
        console.log(res.data.data);
        foods.value = res.data
        loading.value = false
    })
    .catch((err) => {
        console.log(err.response);
    })
}

getFoods()

const increase = () => {
    count.value++;
}

const decrease = () => {
    if(count.value > 0) {
        count.value--;
    }
}

const cart = (food_id) => {
    axiosClient.post(`/customer/restaurants/${props.restaurant_id}/orders`, {food_id: food_id, count: count.value})
}

</script>

<style>

</style>
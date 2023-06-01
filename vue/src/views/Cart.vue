<template>
        <div class="flex justify-center items-center" v-if="loading">
            <Loading />
        </div>
        <div v-else class="mx-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ cart.restaurant.name }}</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">آدرس رستوران: {{ cart.restaurant.address }}</p>
                <hr>
                <div v-for="(order, i) in cart.restaurant.orders" :key="i">
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">نام غذا: {{ order.food_name }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">تعداد غذا: {{ order.food_count }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">قیمت واحد: {{ order.price }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">قیمت کل: {{ order.total_price }}</p>
                    <hr>
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">جمع کل کارت: {{ cart.total_price }}</p>
                <template v-if="cart.status == 'selected'">
                    <button @click.prevent="pay" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        پرداخت
                    </button>
                </template>
            </div>
        </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import axiosClient from "../axios";
import Loading from '../components/Loading.vue'

const props = defineProps(['cart_id'])

const cart = ref([])

const loading = ref(true)

const router = useRouter()

function getCart() {
    axiosClient.get(`/customer/carts/${props.cart_id}`)
    .then((res) => {
        console.log(res);
        cart.value = res.data
        loading.value = false
    })
}

function pay() {
    axiosClient.post(`/customer/carts/${props.cart_id}/pay`)
    .then((res) => {
        router.push({name: 'Carts'})
    })
}

getCart()

</script>

<style>

</style>
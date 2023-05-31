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
            </div>
            <p class="rounded-sm mx-3 bg-slate-300 mb-3 font-normal text-gray-700 dark:text-gray-400">{{ comment.content }}</p>
            <div v-if="!comment.content">
                <form @submit.prevent="handleComment">
                    <div class="m-3">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">پیام</label>
                        <textarea name="content" v-model="content" id="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="نظر خود را وارد نمایید"></textarea>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">ارسال</button>
                    </div>
                </form>
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

const comment = ref({})

const loading = ref(true)

const router = useRouter()

const content = ref('')

function getCart() {
    axiosClient.get(`/customer/carts/${props.cart_id}`)
    .then((res) => {
        console.log(res);
        cart.value = res.data
        loading.value = false
    })
}

function handleComment() {
    axiosClient.post(`/customer/carts/${props.cart_id}/comments`, {content: content.value})
    .then((res) => {
        axiosClient.get(`/customer/carts/${props.cart_id}/comments`)
        .then((res) => {
            comment.value = res.data
        })
    })
}

function getComments() {
    axiosClient.get(`/customer/carts/${props.cart_id}/comments`)
    .then((res) => {
        console.log(res.data);
        comment.value = res.data
    })
}

function getReply() {
    axiosClient.get()
}

getComments()

getCart()

</script>

<style>

</style>
<template>
  <div class="flex flex-col justify-center items-center">
    <div v-if="loading">
      <Loading />
    </div>
    <div
      v-else
      class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700"
    >
      <div class="flex items-center justify-between mb-4">
        <h5
          class="text-xl font-bold leading-none text-gray-900 dark:text-white"
        >
          کارت ها
        </h5>
      </div>
      <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
          <template v-for="cart in carts.data" :key="cart.id">
            <li v-if="cart.status == 'delivered'" class="py-3 sm:py-4">
              <router-link :to="{ name: 'Comment', params: {cart_id: cart.id} }">
                <div class="flex items-center space-x-4">
                  <div class="flex-shrink-0">
                    <img
                      class="w-8 h-8 rounded-full"
                      :src="cart.restaurant.image"
                      alt="Neil image"
                    />
                  </div>
                  <div class="flex-1 min-w-0">
                    <p
                      class="mr-5 text-sm font-medium text-gray-900 truncate dark:text-white"
                    >
                      {{ cart.restaurant.name }}
                    </p>
                  </div>
                  <div
                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
                  >
                    {{ cart.total_price }}
                  </div>
                </div>
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
    <TailwindPagination
      class="mt-3"
      dir="ltr"
      :data="carts"
      @pagination-change-page="getCarts"
    />
  </div>
</template>

<script setup>
import { ref } from "vue";
import axiosClient from "../axios";
import { TailwindPagination } from "laravel-vue-pagination";
import Loading from "../components/Loading.vue";
const carts = ref([]);

const loading = ref(true);

function getCarts(page = 1) {
  axiosClient.get(`/customer/carts?page=${page}`).then((res) => {
    console.log(res);
    carts.value = res.data
    loading.value = false;
  });
}
getCarts();
</script>

<style>
</style>
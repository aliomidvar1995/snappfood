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
      <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
        آدرس ها
      </h5>
    </div>
    <div class="flow-root">
      <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
        <li v-for="address in addresses" :key="address.id" class="py-3 sm:py-4">
          <router-link :to="{ name: 'Profile' }">
            <div class="flex items-center space-x-4">
              <div class="flex-1 min-w-0">
                <p
                  class="mr-5 text-sm font-medium text-gray-900 truncate dark:text-white"
                >
                  {{ address.title }}: {{ address.address }}
                </p>
              </div>
              <div
                class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
              >
              <span v-if="!address.set">
                <button @click.prevent="setAddress(address.id)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-3">ست کردن</button>
              </span>
              </div>
            </div>
          </router-link>
        </li>
      </ul>
    </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import axiosClient from "../axios";
import Loading from '../components/Loading.vue'

const addresses = ref([]);

const loading = ref(true)

function getAddresses() {
  axiosClient.get(`/customer/addresses`).then((res) => {
    console.log(res);
    addresses.value = res.data;
    loading.value = false;
  });
}

function setAddress(address_id) {
  axiosClient.post(`/customer/addresses/${address_id}/set`)
  .then((res) => {
    getAddresses()
  })
}

getAddresses();
</script>

<style>
</style>
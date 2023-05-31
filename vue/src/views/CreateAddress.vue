<template>
    <div class="flex justify-center flex-col items-center w-fit mx-auto">
        <form @submit.prevent="address">
            <select id="title" name="title" v-model="title" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mb-3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>خانه</option>
                <option>محل کار</option>
            </select>
            <input type="hidden" name="latitude" v-model="lat">
            <input type="hidden" name="longitude" v-model="long">
            <NeshanMapLeaflet
                :options="options"
                @latitude="getLatitude"
                @longitude="getLongitude"
            />
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-3" type="submit">ارسال</button>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { NeshanMapLeaflet } from 'vuejs-neshan-map-leaflet';
import axiosClient from '../axios';

const router = useRouter()

const title = ref('خانه')

const lat = ref()

const long = ref()

const options = {
  key: 'web.ab95a829f72a4419befd9a0a8d1929ca',
  maptype: 'dreamy',
  poi: true,
  traffic: false,
  center: [36.30284183765441, 59.5958496945331],
  zoom: 13
}

function getLatitude(latitude) {
  lat.value = latitude;
}

function getLongitude(longitude) {
  long.value = longitude;
}

function address() {
    axiosClient.post(`/customer/addresses`, {title: title.value, latitude: lat.value, longitude: long.value})
    .then((res) => {
      router.push({name: 'Addresses'})
    })
}
</script>
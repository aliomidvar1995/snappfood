<script setup>
import { onMounted, ref } from "vue";
import { onBeforeRouteUpdate } from "vue-router";
import axiosClient from "../axios";
import store from "../store";

const user = ref({
    name: '',
    email: ''
})

    axiosClient.get(`/profile`)
    .then((res) => {
        user.value.name = res.data.name;
        user.value.email = res.data.email;
    })

</script>

<template>
    <div v-if="user.name">
        <div>
            <teleport to="title">dashboard</teleport>
            <h1>dashboard</h1>
            <div class="flex flex-col justify-center align-middle">
                <p>{{ user.name }}</p>
                <p>{{ user.email }}</p>
            </div>
        </div>
    </div>
    <div v-else>
        loading...
    </div>
</template>

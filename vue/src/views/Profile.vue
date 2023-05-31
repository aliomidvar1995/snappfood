<template>
    
    <div class="flex justify-center">
        <div class="overflow-hidden max-w-sm bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="text-center text-white p-6 bg-slate-600 mb-2 text-2xl font-bold tracking-tight dark:text-white">{{ user.name }}</h5>
            <p class="font-normal p-6 text-gray-700 dark:text-gray-400">{{ user.email }}</p>
        </div>
    </div>

</template>

<scrip setup>
import { ref } from "vue";

const user = ref({
    name: "",
    email: "",
});

user.value.name = JSON.parse(localStorage.getItem("user")).name;
user.value.email = JSON.parse(localStorage.getItem("user")).email;

</script>


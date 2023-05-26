<template>
    <div>
        <nav class="bg-slate-900 border-gray-200 dark:bg-gray-900 dark:border-gray-700">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                    <ul
                        class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0  dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <button @click="logout"
                                class="block py-2 pl-3 pr-4 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                log out
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script setup>

    import { useStore } from "vuex";
    import { useRouter } from "vue-router";
    import axiosClient from "../axios";

    const router = useRouter();
    const store = useStore();
    const user = store.state.user;

    function logout() {
        axiosClient.post('/logout')
        .then(({data}) => {
            console.log(data);
            store.state.user = {};
            store.state.token = null;
            sessionStorage.removeItem('TOKEN')
            router.push({name: 'Login'});
            return data;
        })
    }

</script>
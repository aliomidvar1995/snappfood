<template>
    <div>
        <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-gray-100">
    <body class="h-full">
    ```
  -->
        <div dir="rtl" class="min-h-full">
            <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center">
                            <div class="hidden md:block">
                                <div
                                    class="ml-10 flex items-baseline space-x-4 gap-3"
                                >
                                    <router-link
                                        :to="{name: 'Restaurants'}"
                                        class="bg-gray-900 text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium cursor-pointer"
                                        >رستوران ها</router-link
                                    >
                                    <router-link
                                        :to="{name: 'NearRestaurants'}"
                                        class="bg-gray-900 text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium cursor-pointer"
                                        >رستوران های نزدیک</router-link
                                    >
                                    <router-link
                                        :to="{name: 'Comments'}"
                                        class="bg-gray-900 text-white hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium cursor-pointer"
                                        >سفارشات تحویل گرفته شده</router-link
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-4 flex items-center md:ml-6">

                                <!-- Profile dropdown -->
                                <Menu as="div" class="relative ml-[100px]">
                                    <div>
                                        <MenuButton
                                            class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                        >
                                            <span class="sr-only"
                                                >Open user menu</span
                                            >
                                            <img
                                                class="h-8 w-8 rounded-full"
                                                src=""
                                                alt=""
                                            />
                                        </MenuButton>
                                    </div>
                                    <transition
                                        enter-active-class="transition ease-out duration-100"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95"
                                    >
                                        <MenuItems
                                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        >
                                            <MenuItem
                                                v-for="item in userNavigation"
                                                :key="item.name"
                                                v-slot="{ active }"
                                            >
                                                <router-link
                                                    :to="item.href"
                                                    :class="[
                                                        active
                                                            ? 'bg-gray-100'
                                                            : '',
                                                        'block px-4 py-2 text-sm text-gray-700',
                                                    ]"
                                                    >{{ item.name }}</router-link
                                                >
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    @click.prevent="logout"
                                                    class="cursor-pointer"
                                                    :class="[
                                                        active
                                                            ? 'bg-gray-100'
                                                            : '',
                                                        'block px-4 py-2 text-sm text-gray-700',
                                                    ]"
                                                    >خروج</a
                                                >
                                            </MenuItem>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                                <router-link :to="{name: 'Carts'}">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        fill="currentColor"
                                        class="bi bi-cart text-white cursor-pointer"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                                        />
                                    </svg>
                                </router-link>
                            </div>
                        </div>
                        <div class="-mr-2 flex md:hidden">
                            <!-- Mobile menu button -->
                            <DisclosureButton
                                class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            >
                                <span class="sr-only">Open main menu</span>
                                <Bars3Icon
                                    v-if="!open"
                                    class="block h-6 w-6"
                                    aria-hidden="true"
                                />
                                <XMarkIcon
                                    v-else
                                    class="block h-6 w-6"
                                    aria-hidden="true"
                                />
                            </DisclosureButton>
                        </div>
                    </div>
                </div>

                <DisclosurePanel class="md:hidden">
                    <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                        <DisclosureButton
                            v-for="item in navigation"
                            :key="item.name"
                            as="a"
                            :href="item.href"
                            :class="[
                                item.current
                                    ? 'bg-gray-900 text-white'
                                    : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                'block rounded-md px-3 py-2 text-base font-medium',
                            ]"
                            :aria-current="item.current ? 'page' : undefined"
                            >{{ item.name }}</DisclosureButton
                        >
                    </div>
                    <div class="border-t border-gray-700 pb-3 pt-4">
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <img
                                    class="h-10 w-10 rounded-full"
                                    :src="user.imageUrl"
                                    alt=""
                                />
                            </div>
                            <div class="ml-3">
                                <div
                                    class="text-base font-medium leading-none text-white"
                                >
                                    {{ user.name }}
                                </div>
                                <div
                                    class="text-sm font-medium leading-none text-gray-400"
                                >
                                    {{ user.email }}
                                </div>
                            </div>
                            <button
                                type="button"
                                class="ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            >
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="h-6 w-6" aria-hidden="true" />
                            </button>
                        </div>
                        <div class="mt-3 space-y-1 px-2">
                            <DisclosureButton
                                v-for="item in userNavigation"
                                :key="item.name"
                                as="a"
                                :href="item.href"
                                class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                                >{{ item.name }}</DisclosureButton
                            >
                        </div>
                    </div>
                </DisclosurePanel>
            </Disclosure>
            <main>
                <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    <!-- Your content -->
                    <router-view></router-view>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { useRouter } from "vue-router";
import axiosClient from "../axios";
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
} from "@headlessui/vue";
import { Bars3Icon, BellIcon, XMarkIcon } from "@heroicons/vue/24/outline";

const router = useRouter();

function logout() {
    axiosClient.post("/logout").then(({ data }) => {
        console.log(data);
        localStorage.removeItem("user");
        localStorage.removeItem("token");
        router.push({ name: "Login" });
        return data;
    });
}

const userNavigation = [
    { name: "پروفایل", href: {name: 'Profile'} },
    { name: "ویرایش پروفایل", href: {name: 'EditProfile'} },
    { name: "تعیین آدرس", href: {name: 'CreateAddress'} },
    { name: "آدرس ها", href: {name: 'Addresses'} }
];

</script>

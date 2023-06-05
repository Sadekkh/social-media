<template>
    <header class="sticky inset-0 z-10 bg-white drop-shadow-xl dark:bg-neutral-800">
        <div class="flex max-w-2xl md:max-w-[75rem] items-center justify-between px-3 dark:bg-neutral-800 h-16 mx-auto ">
            <Link href="/" class="block">
            <img alt="Logo" src="/profile/logo.png" class="w-full h-10" />
            </Link>
            <div class="relative hidden px-3 pl-5 md:block">
                <span
                    class="absolute inset-y-0 grid ml-3 transition-colors duration-300 hover:cursor-pointer hover:text-blue-600 left-4 place-content-center"
                    @click.once="submitSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>
                <input
                    class="px-4 py-3 pl-10 bg-gray-200 border-none rounded-3xl h-11 focus:outline-none focus:ring-1 focus:ring-blue-600"
                    ref="input" @keypress.enter="submitSearch" v-model="searchForm.keyword">
            </div>
            <div class="flex items-center justify-end w-auto">
                <div class="mr-3">
                    <Link class="inline-flex items-center px-3 primaryBtn" href="/post/create" v-if="user" as="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                    <span class="hidden ml-1 md:block">Post</span>
                    </Link>
                </div>
                <DarkModeButton class="hidden mr-3 md:block" />
                <div class="mr-3" v-if="user">
                    <Link :href="route('user.show', { user: user.id })">
                    <img :src="user.full_image_path" :alt="user.name" class="rounded-full h-11 w-11">
                    </Link>
                </div>
                <div class="mx-3" v-else>
                    <PrimaryBtn type="outline">
                        <Link href="/login">
                        Login
                        </Link>
                    </PrimaryBtn>
                </div>
                <NavBarToggleBtn @click="navBarToggle = !navBarToggle" :toggle-status="navBarToggle" />
            </div>
        </div>
        <div class="absolute w-full max-w-screen-xl px-4 pb-4 mx-auto transition-all duration-300 bg-white navMobile -z-10 dark:bg-neutral-800 md:hidden md:px-8"
            :class="{ appear: navBarToggle }">
            <nav class="" aria-label="header-navigation">
                <ul class="flex flex-col items-center text-sm text-co">
                    <li class="w-full h-10 text-center align-middle">
                        <NavBarLink link="pokedex" @click="toggleNavBar">
                            Pokedex
                        </NavBarLink>
                    </li>
                    <li class="w-full h-10 text-center align-middle">
                        <NavBarLink link="about" @click="toggleNavBar">
                            About
                        </NavBarLink>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script setup lang="ts">
    import User from "@/Types/user.type";
    import { Link, useForm, usePage } from "@inertiajs/vue3";
    import { computed, ref } from "vue";
    import PrimaryBtn from "../PrimaryBtn.vue";
    import DarkModeButton from "./DarkModeButton.vue";
    import NavBarLink from "./NavBarLink.vue";
    import NavBarToggleBtn from "./NavBarToggleBtn.vue";

    const navBarToggle = ref(false);

    const searchForm = useForm({
        keyword: ""
    })

    function toggleNavBar() {
        navBarToggle.value = !navBarToggle.value;
    }

    function submitSearch() {
        searchForm.get(route("post.search"), {
            onSuccess: () => searchForm.reset("keyword")
        });
    }
    const user = computed<User>(() => usePage().props.auth.user);
</script>

<style scoped lang="scss">
    .navMobile {
        transform: translateY(-100 + 4rem);
    }

    .navMobile.appear {
        transform: translateY(0);
    }
</style>

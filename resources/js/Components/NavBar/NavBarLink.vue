<template v-once>
    <Link :href="props.link === 'pokedex' ? '/' : props.link">
    <!-- Todo: change the route active -->
    <button
        class="relative text-lg font-medium font-medium before:absolute before:-bottom-1 before:h-0.5 before:w-full before:scale-x-0 before:bg-gray-800 before:transition hover:before:scale-x-100 dark:before:hover:bg-neutral-200"
        :class="{
            'text-blue-800 before:bg-blue-800 hover:text-blue-800 dark:text-cyan-400 dark:hover:text-cyan-400 dark:before:hover:bg-cyan-400': location.pathname === props.link,
            'text-gray-500 hover:text-gray-800 dark:text-neutral-400  dark:hover:text-neutral-200': location.pathname !== props.link,
        }" @click="$emit('toggleNavBar')">
        <slot></slot>
    </button>
    </Link>
</template>

<script setup>
    import { Link } from "@inertiajs/vue3";
    import { useBrowserLocation } from "@vueuse/core";

    const location = useBrowserLocation();
    const props = defineProps({
        link: String,
    });
</script>

<style scoped></style>

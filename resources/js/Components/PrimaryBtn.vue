<template>
    <button
        :class="{'primaryBtn':type==='primary','primaryOutlineBtn':type==='outline','primaryTextBtn':type==='text'}">
        <slot />
    </button>
</template>
<script setup lang="ts">
    defineProps<{
        type?: "primary" | "outline" | "text"
    }>();
</script>

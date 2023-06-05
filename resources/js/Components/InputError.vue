<script setup>
    defineProps(['message']);
</script>

<template>
    <p class="text-sm text-red-600">
        {{ message }}
    </p>
</template>

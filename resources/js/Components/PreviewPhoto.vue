<template>
    <div class="mb-4" v-if="imgList.length!==0">
        <div class="grid grid-cols-4 gap-2">
            <img :src="img" alt="img" v-for="img in imgList" class="h-[12rem] w-full object-cover rounded-3xl">
        </div>
        <span v-if="errors['photos.0']" class="text-red-600 font-semibold">Only JPG and PNG are supported</span>
    </div>
</template>
<script setup>
    defineProps({
        imgList: Array,
        errors: Object,
    });
</script>

<template>
    <div class="relative">
        <div class="h-full">
            <img :src="photo.photo_src" v-for="(photo, i) in photos" :key="i" class="w-full "
                :class="{ 'object-cover h-72 sm:h-96': !isFullHeight, 'md:h-screen object-contain': isFullHeight }"
                loading="lazy" v-show="i === currentPhoto">
        </div>
        <PrimaryBtn class="absolute p-1 -translate-y-1/2 border-none top-1/2 left-1" type="outline" @click.stop="minusOne"
            v-show="!isFirstPhoto">
            <PreviousIcon />
        </PrimaryBtn>
        <PrimaryBtn class="absolute p-1 -translate-y-1/2 border-none top-1/2 right-1" type="outline" @click.stop="addOne"
            v-show="!isLastPhoto">
            <NextIcon />
        </PrimaryBtn>
    </div>
</template>

<script setup>
    import NextIcon from "@/Components/Icons/NextIcon.vue";
    import PreviousIcon from "@/Components/Icons/PreviousIcon.vue";
    import PrimaryBtn from "@/Components/PrimaryBtn.vue";
    import { computed, ref } from "vue";

    const { photos, isFullHeight } = defineProps({
        photos: Object,
        isFullHeight: {
            type: Boolean,
            default: false,
        },
    });

    const currentPhoto = ref(0);
    const isFirstPhoto = computed(() => currentPhoto.value === 0);
    const isLastPhoto = computed(() => (photos.length - 1) === currentPhoto.value);

    const addOne = () => !isLastPhoto.value && currentPhoto.value++;
    const minusOne = () => !isFirstPhoto.value && currentPhoto.value--;
</script>

<style scoped></style>

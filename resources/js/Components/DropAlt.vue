<template>
    <div class="relative" ref="dropdown">
        <PrimaryBtn class="h-10 p-2" type="text" @click.stop="isDropdownActive = !isDropdownActive">
            <EllipsisVerticalIcon />
        </PrimaryBtn>
        <div class="absolute right-0 z-10 bg-white border-[1px] border-gray-500/20 rounded-3xl w-32 group"
            :class="{ 'fade': isDropdownActive }" v-show="isDropdownActive">
            <slot />
        </div>
    </div>
</template>
<script setup lang="ts">
    import EllipsisVerticalIcon from "@/Components/Icons/EllipsisVerticalIcon.vue";
    import PrimaryBtn from "@/Components/PrimaryBtn.vue";
    import { onClickOutside } from "@vueuse/core";
    import { ref } from "vue";

    const isDropdownActive = ref(false);

    const dropdown = ref<HTMLDivElement>(null);
    onClickOutside(dropdown, () => isDropdownActive.value = false);

</script>
<style>
    .fade {
        animation: fade 300ms cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
    }

    @keyframes fade {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

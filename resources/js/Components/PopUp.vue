<template>
    <Teleport to="body">
        <Transition>
            <div v-if="isShown" ref="popUp"
                class="fixed rounded-3xl bg-white/95 backdrop-blur-2xl -translate-x-1/2 p-8 top-1/3 left-1/2 max-w-[30rem] drop-shadow-2xl">
                <h2 class="mb-5 text-lg font-semibold text-center">
                    <slot name="title" />
                </h2>
                <div class="mb-5">
                    <slot name="content" />
                </div>
                <div class="flex justify-end">
                    <slot name="buttons" />
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
    
    import { ref } from "vue";
    import { onClickOutside } from "@vueuse/core";
    
    const popUp = ref(null);
    let { isShown } = defineProps({
        isShown: Boolean,
    });
    const emits = defineEmits([
        "clickedOutside",
    ]);
    
    onClickOutside(popUp, () => emits("clickedOutside"));
</script>

<style lang="scss">
    .v-enter-active,
    .v-leave-active {
        transition: all 0.3s ease;
    }

    .v-enter-from,
    .v-leave-to {
        opacity: 0;
    }
</style>

<script setup>
    import { onMounted, ref } from "vue";

    defineProps(["modelValue"]);

    defineEmits(["update:modelValue"]);

    const input = ref(null);

    onMounted(() => {
        if (input.value.hasAttribute("autofocus")) {
            input.value.focus();
        }
    });
</script>

<template>
    <input class="rounded-3xl py-3 px-4 h-11 focus:outline-none focus:ring-1 focus:ring-blue-600 border-none bg-gray-200"
           :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

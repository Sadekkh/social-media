<template>
  <Teleport to="body">
    <Transition>
      <div class="fixed flex px-4 py-2 text-white bg-green-600/95 bottom-4 right-4 rounded-3xl drop-shadow-2xl"
        :class="{}" v-if="$props.text && isShown">
        {{ $props.text }}
        <XIcon class="ml-1 hover:cursor-pointer hover:scale-110" @click="() => isShown = false" />
      </div>
    </Transition>
  </Teleport>
</template>
<script setup lang="ts">
  import { ref } from 'vue';
  import XIcon from './Icons/XIcon.vue';
  import { onMounted } from 'vue';

  const isShown = ref(true);
  const props = defineProps<{
    text: string | null | unknown,
    duration?: number
  }>()
  onMounted(() => {
    setTimeout(() => {
      isShown.value = false
    }, typeof props.duration === "number" ? props.duration : 500);
  })
</script>
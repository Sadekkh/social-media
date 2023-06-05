<template>
  <div class="max-w-2xl px-2 mx-auto">
    <h3 class="mb-3 text-xl font-semibold">Results for {{ keyword }}</h3>
    <Post v-for="(post, i) in $props.posts" :post="post" :key="`${post.id}post${i}`" v-memo="[post.user_liked_count]" />
    <div class="max-w-2xl border-[1px] rounded-3xl px-6 py-3 text-center" v-if="!posts.length">
      There are no posts for keyword "{{ $props.keyword }}"
    </div>
  </div>
  <TextToast :text="$page.props.message" :duration="1000" />
</template>
<script setup lang="ts">
  import Post from "@/Components/Post/Post.vue";
  import TextToast from "@/Components/TextToast.vue";
  import { default as PostType } from "@/Types/post.type"

  const props = defineProps<{
    posts: PostType[],
    keyword: String
  }>();
</script>
<script lang="ts">
  import PageLayout from "@/Layouts/PageLayout.vue";

  export default {
    layout: PageLayout,
  };
</script>

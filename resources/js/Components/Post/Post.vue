<template>
    <div class="bg-white border-x-[1px] border-b-[1px] border-gray-500/20 first-of-type:border-t-2 first-of-type:rounded-t-3xl last-of-type:rounded-b-3xl hover:cursor-pointer hover:bg-gray-200/50 transition-colors duration-300"
        @click.stop="goToPost">
        <PostProfile :post="post" />
        <div class="px-4 pb-3" v-if="post.description">
            <p class="text-lg">{{ post.description }}</p>
        </div>
        <template v-if="!post.original_post">
            <img :src="post.post_photos[0].photo_src" class="h-80 md:h-[30rem] w-full object-cover"
                v-if="post.post_photos.length === 1">
            <PhotoCarousel :photos="post.post_photos" v-if="post.post_photos.length > 1" />
        </template>
        <!--        Section for shared post -->
        <template v-else>
            <img :src="post.original_post.post_photos[0].photo_src" class="h-80 md:h-[30rem] w-full object-cover"
                v-if="post.original_post.post_photos.length === 1">
            <PhotoCarousel :photos="post.original_post.post_photos" v-if="post.original_post.post_photos.length > 1" />
            <div class="bg-white hover:bg-white/10 mx-3 border-x-[1px] border-b-[1px] rounded-b-3xl"
                :class="{ 'border-t-[1px] rounded-t-3xl': post.original_post.post_photos.length === 0 }">
                <PostProfile :post="post.original_post" />
                <div class="px-4 pb-3" v-if="post.original_post.description">
                    <p class="text-lg">{{ post.original_post.description }}</p>
                </div>
            </div>
        </template>
        <PostReaction :post-id="post.id" :total-likes="post.total_likes_count" :user-liked="post.user_liked_count >= 1"
            :total-comments="post.all_comments_count" />
    </div>
</template>
<script setup lang="ts">
    import PhotoCarousel from "@/Components/PhotoCarousel.vue";
    import PostProfile from "@/Components/Post/PostProfile.vue";
    import PostReaction from "@/Components/Post/PostReaction.vue";
    import Post from "@/Types/post.type";
    import { router } from "@inertiajs/vue3";

    const props = defineProps<{
        post: Post
    }>()
    function goToPost() {
        router.visit(route("post.show", { id: props.post.id }), { preserveScroll: true });
    }
</script>

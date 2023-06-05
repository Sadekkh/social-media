<template>
    <div class="flex p-1.5 justify-around">
        <button
            class="inline-flex items-center justify-center w-full font-semibold transition-colors duration-300 bg-transparent group hover:text-indigo-500"
            :class="{ 'text-indigo-600': userLiked, 'text-gray-900/80': !userLiked }" @click.stop.prevent="toggleLike">
            <a class="p-2 mr-1 rounded-full group-hover:bg-indigo-200/80 group-active:bg-indigo-300/80">
                <LikeSolid v-if="userLiked" class="text-indigo-600" />
                <LikeOutline v-else />
            </a>
            {{ totalLikes }} {{ totalLikes > 1 ? "Likes" : "Like" }}
        </button>
        <button
            class="inline-flex items-center justify-center w-full font-semibold transition-colors duration-300 bg-transparent text-gray-900/80 group hover:text-indigo-600">
            <a class="p-2 mr-1 rounded-full group-hover:bg-indigo-200/80 group-active:bg-indigo-300/80">
                <CommentIcon class="" />
            </a>
            {{ totalComments }} {{ totalComments > 1 ? "Comments" : "Comment" }}
        </button>
        <button
            class="inline-flex items-center justify-center w-full font-semibold transition-colors duration-300 bg-transparent text-gray-900/80 group hover:text-indigo-600"
            @click.stop.prevent="sharePost">
            <a class="p-2 mr-1 rounded-full group-hover:bg-indigo-200/80 group-active:bg-indigo-300/80">
                <ShareIcon />
            </a>
            Share
        </button>
    </div>
</template>
<script setup>
    import CommentIcon from "@/Components/Icons/CommentIcon.vue";
    import LikeOutline from "@/Components/Icons/LikeOutline.vue";
    import LikeSolid from "@/Components/Icons/LikeSolid.vue";
    import ShareIcon from "@/Components/Icons/ShareIcon.vue";
    import { router } from "@inertiajs/vue3";

    const props = defineProps({
        postId: Number,
        totalLikes: Number,
        userLiked: Boolean,
        totalComments: Number
    });

    function toggleLike() {
        router.post(route(props.userLiked ? "post.unlike" : "post.like"), { "post_id": props.postId }, {
            preserveScroll: true,
            only: ["posts"]
        });
    }

    function sharePost() {
        router.post(route("post.share"), { "description": "alskdfj", "post_id": props.postId }, {
            preserveScroll: true,
        });
    }
</script>

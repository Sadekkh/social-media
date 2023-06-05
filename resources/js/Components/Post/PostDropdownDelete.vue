<template>
    <button @click.prevent.stop="doesPopUpShow = true" class="dropdownButton">
        Delete
    </button>
    <PopUp :is-shown="doesPopUpShow" @clicked-outside="doesPopUpShow = false">
        <template v-slot:title>
            Are you sure you want to delete?
        </template>
        <template v-slot:buttons>
            <PrimaryBtn type="outline" class="mr-3 text-red-600 border-red-600 hover:bg-red-600" @click.stop="deletePost">
                Delete
            </PrimaryBtn>
            <PrimaryBtn type="primary" @click.stop="doesPopUpShow = false">Cancel</PrimaryBtn>
        </template>
    </PopUp>
</template>
<script setup>
    import { router } from "@inertiajs/vue3";
    import { ref } from "vue";
    import PrimaryBtn from "@/Components/PrimaryBtn.vue";
    import PopUp from "@/Components/PopUp.vue";

    const doesPopUpShow = ref(false);
    const props = defineProps({
        postId: Number,
    });

    function deletePost() {
        router.post(route("post.destroy", { id: props.postId }), {
            _method: "delete",
        }, {
            onFinish: (data) => {
                if (data.completed) {
                    router.reload({ only: ["posts"] });
                }
            },
            preserveScroll: true,
        });
    }
</script>
<style></style>

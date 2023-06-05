<template>
    <form @submit.prevent="submit" class="max-w-2xl px-8 py-4 mx-auto bg-gray-100 rounded-3xl"
        enctype="multipart/form-data">
        <h1 class="mb-4 text-3xl font-semibold">Create Post</h1>
        <textarea name="description" id="description" rows="4" placeholder="Write something..."
            class="w-full p-4 mb-4 bg-gray-200 border-none resize-none rounded-3xl focus:outline-none"
            v-model="form.description"></textarea>
        <PreviewPhoto :img-list="imgList" :errors="errors" />
        <div class="flex justify-between">
            <input type="file" accept="image/jpeg,image/png" class="hidden" id="photoUpload" ref="fileUploadRef"
                @input="uploadAndPreviewPhoto" multiple>
            <label for="photoUpload">
                <PrimaryBtn type="primary" class="px-3" @click.prevent="fileUploadRef.click()">
                    <Media />
                </PrimaryBtn>
            </label>
            <PrimaryBtn type="primary">Create Post</PrimaryBtn>
        </div>
        <InputError :message="errors.description" v-if="errors.description" class="mt-3" />
    </form>
</template>
<script setup lang="ts">
    import Media from "@/Components/Icons/Media.vue";
    import PreviewPhoto from "@/Components/PreviewPhoto.vue";
    import PrimaryBtn from "@/Components/PrimaryBtn.vue";
    import InputError from "@/Components/InputError.vue";
    import { useForm } from "@inertiajs/vue3";
    import { ref } from "vue";

    const imgList = ref([]);
    const fileUploadRef = ref<HTMLInputElement>(null);


    defineProps({
        errors: Object,
    });

    const form = useForm({
        description: "",
        photos: [],
    });

    function uploadAndPreviewPhoto(event) {
        for (let i = 0; i < event.target.files.length; i++) {
            imgList.value.push(URL.createObjectURL(event.target.files[i]));
            form.photos.push(event.target.files[i]);
        }
    }

    const submit = () => {
        form.post(route("post.store"));
    };
</script>
<script lang="ts">
    import PageLayout from "@/Layouts/PageLayout.vue";

    export default {
        layout: PageLayout,
    };
</script>

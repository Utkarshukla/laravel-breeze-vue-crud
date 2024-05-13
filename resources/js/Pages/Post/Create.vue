<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

defineProps({
    category: {
        required: true
    }
});

const form = useForm({
    title: '',
    short_description: '',
    long_description: '',
    thumbnail: null,
    category_id: '',
});

const submitForm = () => {
    form.post(route('post.store'), {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
        onSuccess: () => {
            form.reset();
        },
    });
};
watch(()=>form.category_id,(newValue)=>{
form.category_id = newValue;
console.log(form);
});
const onThumbnailChange = (event) => {
    const file = event.target.files[0];
    form.thumbnail = file;
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Post</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submitForm">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" id="title" v-model="form.title" required
                                    class="mt-1 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full">
                            </div>
                            <div class="mt-4">
                                <label for="short_description" class="block text-sm font-medium text-gray-700">Short
                                    Description</label>
                                <textarea id="short_description" v-model="form.short_description" required rows="2"
                                    class="mt-1 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full"></textarea>
                            </div>
                            <div class="mt-4">
                                <label for="long_description" class="block text-sm font-medium text-gray-700">Long
                                    Description</label>
                                <textarea id="long_description" v-model="form.long_description" required rows="4"
                                    class="mt-1 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full"></textarea>
                            </div>
                            <div class="mt-4">
                                <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail</label>
                                <input type="file" id="thumbnail" accept="image/png, image/avif, image/webp, image/jpeg"
                                    @change="onThumbnailChange" 
                                    class="mt-1 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full">
                            </div>
                            <div class="mt-4">
                                <label for="category_id"
                                    class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="category_id" v-model="form.category_id" required
                                    class="mt-1 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full">
                                    <option value="" disabled selected>Select a category</option>
                                    <option v-for="cat in category" :key="cat.id" :value="cat.id" class="text-gray-700">
                                        {{ cat.category }}
                                    </option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <button type="submit" 
                                
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

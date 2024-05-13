<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
defineProps({
    posts: {
        type: Object,
        required: true
    },
    postRoute: {
        required: true,
    },
    editRoute: {
        required: true,
    },
    deleteRoute: {
        required: true,
    },
});

// const deleteRoute = () => {
//     deletePost(route('post.delete', { id: post.id }));
// };
const deleteForm= useForm({});
const deleteRoute = (id) => {
    deleteForm.delete(route('post.delete',id));
};

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="bg-white rounded-lg shadow-md p-6">

                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Post Title</th>
                                        <th>Category</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="post in posts.data" :key="post.id">
                                        <th>
                                            <Link :href="postRoute.replace('__post_id__', post.id)">
                                            <img :src="'http://127.0.0.1:8000/storage/' + post.thumbnail"
                                                alt="Thumbnail" class="mt-4 w-1/1 p-5 rounded-lg">
                                            </Link>
                                        </th>
                                        <th>{{ post.title }}</th>
                                        <th>{{ post.category_list.category }}</th>
                                        <th>{{ post.created_at }}</th>
                                        <th>
                                            <Link :href="editRoute.replace('__post_edit__', post.id)"><button
                                                type="submit"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Edit
                                            </button></Link>
                                        </th>
                                        <th>
                                            <!-- <Link :href="deleteRoute.replace('__post_delete__', post.id)"> -->
                                                <button
                                                type="submit"
                                                @click="deleteRoute(post.id)"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Delete
                                            </button>
                                        <!-- </Link> -->
                                        </th>
                                    </tr>

                                </tbody>
                            </table>

                            <p class="mt-4 text-sm text-gray-400"></p>
                            <p class="mt-2 text-sm text-gray-400"> </p>
                        </div>
                        <Pagination :data="posts" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import { computed, onMounted } from "vue";

const name = computed(() => {
    return usePage().props.auth.user.firstName;
});
const isLoggedIn = computed(() => {
    return usePage().props.auth.user;
});
defineProps({
    users: {
        type: Object,
        required: true,
    },
});
onMounted(() => {});
</script>

<template>
    <Head>
        <title>| Dashboard</title>
        <meta content="This page is home dashboard" name="description" />
    </Head>
    <div v-if="$page.props.flash.message" class="alert w-1/2 mx-auto">
        <h2 class="p-4 bg-green-300 font-bold rounded mt-3 text-center">
            {{ $page.props.flash.message + " " + name + "!" }}
        </h2>
    </div>
    <div class="flex justify-end">
        <Link
            :href="route('logout')"
            as="button"
            class="bg-blue-400 mt-5 mr-10 w-auto p-2.5 rounded hover:bg-blue-600"
            method="post"
            type="button"
            >Logout
        </Link>
    </div>

    <div class="w-3/5 mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th class="px-6 py-3" scope="col">Photo</th>
                    <th class="px-6 py-3" scope="col">Name</th>
                    <th class="px-6 py-3" scope="col">Email</th>
                    <th class="px-6 py-3" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <td class="px-6 py-4">
                        <img
                            :src="
                                user.avatar_path ??
                                'storage/avatars/default_photo.jpg'
                            "
                            alt="Profile photo of {{ user.firstName }}"
                            class="max-w-20 rounded"
                        />
                    </td>
                    <td class="px-6 py-4 font-medium whitespace-nowrap">
                        {{ user.firstName + " " + user.lastName }}
                    </td>
                    <td class="px-6 py-4">{{ user.email }}</td>
                    <td class="px-6 py-4">
                        <a
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                            href="#"
                            >Edit</a
                        >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--    Pagination link-->
    <div>
        <Link
            v-for="link in users.links"
            :key="link.label"
            :class="{ 'bg-blue-400': link.active }"
            :href="link.url"
            class="mx-1 px-1 rounded"
            v-html="link.label"
        >
        </Link>
        >
    </div>
</template>
<style scoped></style>

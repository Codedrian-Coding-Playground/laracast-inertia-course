<script setup>
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";
import { debounce } from "lodash";

const name = computed(() => {
    return usePage().props.auth.user.firstName;
});
const isLoggedIn = computed(() => {
    return usePage().props.auth.user;
});
defineProps({
    users: {
        type: Object,
    },
    searchValue: {
        type: String,
    },
    errors: Array,
    flash: String,
    auth: Object,
    permissions: Object,
});

const search = ref("");
watch(
    search,
    debounce(
        (user) =>
            router.get(
                "/",
                {
                    search: user,
                },
                { preserveState: true },
            ),
        500,
    ),
);

/*Delete*/
function deleteUser(id) {
    router.delete("users/" + id);
}
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
    <p>Email: {{ auth.user.email }}</p>
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
    <div v-if="users.data.length > 0">
        <form class="w-full flex justify-end p-5">
            <label
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
                for="default-search"
                >Search</label
            >
            <div class="relative w-2/6">
                <div
                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
                >
                    <svg
                        aria-hidden="true"
                        class="w-4 h-4 text-gray-500 dark:text-gray-400"
                        fill="none"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        />
                    </svg>
                </div>
                <input
                    id="default-search"
                    v-model="search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search User..."
                    required
                    type="search"
                />
                <button
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="submit"
                >
                    Search
                </button>
            </div>
        </form>
        <div
            class="w-3/5 mx-auto relative overflow-x-auto shadow-md sm:rounded-lg flex flex-col"
        >
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th class="px-6 py-3" scope="col">Photo</th>
                        <th class="px-6 py-3" scope="col">Name</th>
                        <th
                            v-if="permissions.can.delete_user"
                            class="px-6 py-3"
                            scope="col"
                        >
                            Email
                        </th>
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
                                class="max-w-20 h-20 rounded"
                            />
                        </td>
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ user.firstName + " " + user.lastName }}
                        </td>
                        <td class="px-6 py-4">{{ user.email }}</td>
                        <td
                            v-if="permissions.can.delete_user"
                            class="px-6 py-4"
                        >
                            <button
                                class="font-medium text-white bg-red-600 hover:bg-red-800 p-1 rounded"
                                @click="deleteUser(user.id)"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--    Pagination link-->
        <div class="flex justify-between mt-5">
            <div class="ml-10">
                <Link
                    v-for="link in users.links"
                    :key="link.label"
                    :class="{ 'bg-blue-400': link.active }"
                    :href="link.url"
                    class="mx-1 px-1 rounded"
                    v-html="link.label"
                >
                </Link>
            </div>
            <p class="justify-self-end mr-10">
                Showing {{ users.from }} to {{ users.to }} of
                {{ users.total }} results
            </p>
        </div>
    </div>
    <div v-else>
        <p class="mx-auto w-fit text-2xl">No record found</p>
    </div>
</template>
<style scoped></style>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { useForm } from "laravel-precognition-vue-inertia";

const form = useForm("post", "/users", {
    firstName: "",
    lastName: "",
    email: "",
    password: "",
    avatar_path: null,
    avatarPreview: null,
});
const submit = () =>
    form.submit({
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => form.reset("password"),
    });

function handleImage(event) {
    form.avatar_path = event.target.files[0];
    form.avatarPreview = URL.createObjectURL(event.target.files[0]);
}
</script>

<template>
    <Head title="| Register"></Head>
    <div class="w-full max-w-96 mx-auto mt-9">
        <form
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
            @submit.prevent="submit"
        >
            <!--TODO: Profile-->
            <div class="flex items-center space-x-6 mb-6">
                <div class="shrink-0">
                    <img
                        id="preview_img"
                        :src="
                            form.avatarPreview ??
                            'storage/avatars/default_photo.jpg'
                        "
                        alt="Current profile photo"
                        class="h-16 w-16 object-cover rounded-full"
                    />
                </div>
                <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"
                        type="file"
                        @input="handleImage($event)"
                    />
                </label>
                <div v-if="form.invalid('avatar')" class="text-red-500">
                    {{ form.errors.avatar }}
                </div>
            </div>
            <progress
                v-if="form.progress"
                :value="form.progress.percentage"
                max="100"
            >
                {{ form.progress.percentage }}%
            </progress>
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="username"
                >
                    First Name
                </label>
                <input
                    v-model="form.firstName"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="John"
                    type="text"
                    @change="form.validate('firstName')"
                />
                <small v-if="form.invalid('firstName')" class="text-red-500">
                    {{ form.errors.firstName }}
                </small>
            </div>
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="username"
                >
                    Last Name
                </label>
                <input
                    v-model="form.lastName"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Doe"
                    type="text"
                    @change="form.validate('lastName')"
                />
                <div v-if="form.invalid('lastName')" class="text-red-500">
                    {{ form.errors.lastName }}
                </div>
            </div>
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="username"
                >
                    Email
                </label>
                <input
                    id="username"
                    v-model="form.email"
                    :class="{
                        'outline-green-500': form.valid('email'),
                        'outline-red-500': form.invalid('email'),
                    }"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:shadow-outline"
                    placeholder="john.doe@gmail.com"
                    type="text"
                    @change="form.validate('email')"
                />
                <div v-if="form.invalid('email')" class="text-red-500">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mb-6">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="password"
                >
                    Password
                </label>
                <input
                    id="password"
                    v-model="form.password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="******************"
                    type="password"
                    @change="form.validate('password')"
                />
                <div v-if="form.invalid('password')" class="text-red-500">
                    {{ form.errors.password }}
                </div>
            </div>
            <div class="flex flex-col items-center justify-between">
                <button
                    :class="{
                        'bg-gray-500 cursor-not-allowed': form.processing,
                    }"
                    :disabled="form.processing"
                    class="w-full mb-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Sign In
                </button>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Already have an account?
                    <Link
                        :href="route('login')"
                        class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                        >Login here
                    </Link>
                </p>
            </div>
        </form>
    </div>
</template>

<style scoped></style>

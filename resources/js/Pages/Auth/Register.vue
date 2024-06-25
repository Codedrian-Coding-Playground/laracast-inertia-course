<script setup>
import { Head } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue-inertia';
import { reactive } from 'vue';

const form = useForm('post', '/register', {
    firstName: '',
    lastName: '',
    email: '',
    password: '',
})
const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => form.reset('password'),
});
</script>

<template>
    <Head title="| Register"></Head>
    <div class="w-full max-w-xs mx-auto mt-9">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    First Name
                </label>
                <input
                    v-model="form.firstName"
                    @change="form.validate('firstName')"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none
                    focus:shadow-outline" type="text" placeholder="John">
                <div v-if="form.invalid('firstName')" class="text-red-500">
                    {{ form.errors.firstName }}
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Last Name
                </label>
                <input
                    @change="form.validate('lastName')"
                    v-model="form.lastName"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none
                    focus:shadow-outline" type="text" placeholder="Doe">
                <div v-if="form.invalid('lastName')" class="text-red-500">
                    {{ form.errors.lastName }}
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Email
                </label>
                <input
                    v-model="form.email"
                    @change="form.validate('email')"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                    focus:shadow-outline" id="username" type="text" placeholder="john.doe@gmail.com"
                    :class="{'outline-green-500': form.valid('email'), 'outline-red-500': form.invalid('email')}">

                <div v-if="form.invalid('email')" class="text-red-500">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input
                    v-model="form.password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none
                    focus:shadow-outline" id="password" type="password" placeholder="******************">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        :disabled="form.processing"
                        :class="{'bg-gray-500 cursor-not-allowed': form.processing }"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Sign In
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                    Forgot Password?
                </a>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>

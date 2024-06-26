<script setup>
import TextInput from '../../components/TextInput.vue';
import {Head, Link} from "@inertiajs/vue3";
import { useForm } from 'laravel-precognition-vue-inertia';

const form = useForm('post', '/login', {
    email: '',
    password: '',
    remember_me: '',
});
const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
});

</script>

<template>
    <Head title="| Login"></Head>
    <div class="w-full max-w-xs mx-auto mt-9">
        {{ form.remember_me}}
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit">
            <TextInput
                v-model="form.email"
                name="Email"
                type="email"
                id="email"
                placeholder="John Doe"
                is_valid="form.invalid('email')"
                @change="form.validate('email')"
            />
            <div v-if="form.invalid('email')" class="text-red-500">
                <small>{{ form.errors.email }}</small>
            </div>

            <TextInput
                v-model="form.password"
                name="Password"
                type="password"
                id="password"
                placeholder="******************"
                @change="form.validate('password')"
            />
            <div v-if="form.invalid('password')" class="text-red-500">
                <small>{{ form.errors.password }}</small>
            </div>
            <div class="flex flex-col items-center justify-between">
                <div class="flex  justify-start w-full gap-2">
                    <input type="checkbox" name="remember_me" v-model="form.remember_me">
                    <label for="remember_me">Remember me</label>
                </div>

                <button type="submit"
                        :disabled="form.processing"
                        :class="{'bg-gray-500 cursor-not-allowed': form.processing }"
                        class="w-full mb-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Sign In
                </button>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Don't have an account? <Link :href="route('register')" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Register here</Link>
                </p>
            </div>
        </form>
    </div>
</template>

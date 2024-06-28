<script setup>
import TextInput from '../../components/TextInput.vue';
import {Head, Link} from "@inertiajs/vue3";
import {useForm} from 'laravel-precognition-vue-inertia';

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
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit">
            <TextInput
                id="email"
                v-model="form.email"
                is_valid="form.invalid('email')"
                name="Email"
                placeholder="John Doe"
                type="email"
                @change="form.validate('email')"
            />
            <div v-if="form.invalid('email')" class="text-red-500">
                <small>{{ form.errors.email }}</small>
            </div>
            <TextInput
                id="password"
                v-model="form.password"
                name="Password"
                placeholder="******************"
                type="password"
                @change="form.validate('password')"
            />
            <div v-if="form.invalid('password')" class="text-red-500">
                <small>{{ form.errors.password }}</small>
            </div>
            <div class="flex flex-col items-center justify-between">
                <div class="flex  justify-start w-full gap-2">
                    <input v-model="form.remember_me" name="remember_me" type="checkbox">
                    <label for="remember_me">Remember me</label>
                </div>

                <button :class="{'bg-gray-500 cursor-not-allowed': form.processing }"
                        :disabled="form.processing"
                        class="w-full mb-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                    Sign In
                </button>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Don't have an account?
                    <Link :href="route('register')" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Register here</Link>
                </p>
            </div>
        </form>
    </div>
</template>

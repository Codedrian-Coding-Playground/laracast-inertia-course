<script setup>
import {Head, Link, usePage} from '@inertiajs/vue3';
import { ref, computed } from 'vue'
const name = computed(() => {
    return usePage().props.auth.user.firstName;
});
</script>

<template>
    <Head>
        <title>| Dashboard</title>
        <meta name="description" content="This page is home dashboard">
    </Head>
    <Link :href="route('logout')" method="post" as="button" type="button" class="bg-blue-500 mt-5">Logout</Link>
    <p>Welcome, {{ name }}</p>
</template>
<style scoped>

</style>

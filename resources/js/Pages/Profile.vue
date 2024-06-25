<script setup>

import {Head} from "@inertiajs/vue3";
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage();
const user = computed(() => page.props.auth.user)
</script>

<template>
    <Head>
        <title>| Profile</title>
        <meta name="description" content="This page is Profile">
    </Head>
        <p class="w-1/2">{{ $page.props.auth.user.name }}</p>
    <p>{{ user.name }}</p>
</template>

<style scoped>

</style>

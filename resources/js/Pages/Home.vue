<script setup>
import {Head, Link} from '@inertiajs/vue3';
import { ref } from 'vue'

defineProps({
    profileUrl: String
})
const username = ref();
const password = ref();
const checked = ref();
</script>

<template>
    <Head>
        <title>| Dashboard</title>
        <meta name="description" content="This page is home dashboard">
    </Head>


</template>
<style scoped>

</style>

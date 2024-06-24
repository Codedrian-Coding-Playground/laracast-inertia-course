<script setup>
import { Head } from '@inertiajs/vue3';
import Greeting from '../components/Greeting.vue';
import { ref } from 'vue'

defineProps({
    profileUrl: String
})
const messages = ref([
    'Hello',
    'Hi'
]);
</script>

<template>
    <Head>
        <title>Dashboard</title>
        <meta name="description" content="Your page description">
    </Head>
    <div  v-for="message in messages">
        <Greeting :message="message"/>
    </div>
</template>
<style scoped>

</style>

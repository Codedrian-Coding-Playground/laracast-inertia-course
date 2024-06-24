<script setup>
import Greeting from '../components/Greeting.vue';
defineProps({
    profileUrl: String
})
</script>

<template>
<h1 class="text-red-600">This is Home</h1>
    <Greeting></Greeting>
<a :href="profileUrl" class="hover:bg-blue-700">Click to go to Profile page</a>
</template>
<style scoped>

</style>

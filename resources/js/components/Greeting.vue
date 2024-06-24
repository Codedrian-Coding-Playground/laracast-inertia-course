<script setup>
defineProps({
    message: String
})
</script>

<template>
<p>{{ message }}</p>
    <slot></slot>
</template>

<style scoped>

</style>

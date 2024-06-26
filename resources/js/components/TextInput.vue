<script setup>
/*To bind to the parent*/
const model = defineModel({
    type: String,
    required: true,
})
defineProps({
    name: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        required: true,
    },
    id: {
        type: String,
        required: true,
    },
    placeholder: {
        type: String,
        required: true,
    }
});
</script>

<template>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">{{ name }}</label>
        <input
            v-model="model"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:shadow-outline" :id="id" :type="type"
            :placeholder="placeholder">
    </div>
</template>

<style scoped>

</style>

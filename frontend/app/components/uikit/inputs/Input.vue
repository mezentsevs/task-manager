<template>
    <input
        v-model="model"
        class="px-3 py-2 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-300 bg-white dark:bg-gray-900 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm" />
</template>

<script setup lang="ts">
import type { UikitInputModel } from '~/types/UikitTypes';

const model = defineModel<UikitInputModel>();
</script>

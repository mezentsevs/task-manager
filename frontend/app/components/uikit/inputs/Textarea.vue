<template>
    <textarea
        v-model="model"
        class="custom-scroll-textarea px-3 py-2 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-300 bg-white dark:bg-gray-900 rounded-md shadow-sm" />
</template>

<script setup lang="ts">
import type { UikitInputModel } from '~/types/UikitTypes';

const model = defineModel<UikitInputModel>();
</script>

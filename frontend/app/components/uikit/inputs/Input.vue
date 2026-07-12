<template>
    <input
        v-model="model"
        class="px-3 py-2 text-gray-900 bg-white dark:text-gray-300 dark:bg-gray-900 rounded-md" />
</template>

<script setup lang="ts">
import type { UikitInputModel } from '~/types/UikitTypes';

const model = defineModel<UikitInputModel>();
</script>

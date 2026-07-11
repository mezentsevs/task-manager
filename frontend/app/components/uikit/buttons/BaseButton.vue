<template>
    <button
        :type
        class="border-transparent rounded-md px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out border hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 active:bg-gray-900 disabled:opacity-50 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">
        <slot />
    </button>
</template>

<script setup lang="ts">
import type { UikitButton } from '~/types/UikitTypes';

defineProps<{
    type: UikitButton;
}>();
</script>

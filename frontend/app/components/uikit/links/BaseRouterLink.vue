<template>
    <NuxtLink
        :to
        class="text-sm underline text-blue-500 hover:text-gray-700 active:text-gray-900 dark:text-gray-200 dark:hover:text-gray-100 dark:active:text-gray-300 transition duration-150 ease-in-out">
        <slot />
    </NuxtLink>
</template>

<script setup lang="ts">
import type { UikitRouterLinkTo } from '~/types/UikitTypes';

defineProps<{
    to: UikitRouterLinkTo;
}>();
</script>

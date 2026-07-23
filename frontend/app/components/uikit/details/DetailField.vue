<template>
    <div class="mb-4">
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ label }}</p>
        <slot>
            <p class="text-gray-900 dark:text-gray-100 break-words">{{ value }}</p>
        </slot>
    </div>
</template>

<script setup lang="ts">
defineProps<{
    label: string;
    value?: string;
}>();
</script>

<template>
    <component :is="heading" class="font-bold truncate text-gray-800 dark:text-gray-200">
        <slot />
    </component>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        level?: number;
    }>(),
    {
        level: 1,
    },
);

const heading = computed((): string => {
    if (props.level < 1) {
        return 'h1';
    }

    if (props.level > 6) {
        return 'h6';
    }

    return `h${props.level}`;
});
</script>

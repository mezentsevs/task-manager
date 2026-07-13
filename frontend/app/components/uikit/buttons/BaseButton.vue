<template>
    <button
        :type
        class="inline-flex items-center justify-center rounded-md px-4 py-2 text-xs font-semibold uppercase tracking-widest transition duration-150 ease-in-out">
        <slot />
    </button>
</template>

<script setup lang="ts">
import type { UikitButton } from '~/types/UikitTypes';

defineProps<{
    type: UikitButton;
}>();
</script>

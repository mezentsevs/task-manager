<template>
    <span class="rounded-full px-2 py-1 text-xs font-semibold" :class="colorClasses">
        <slot />
    </span>
</template>

<script setup lang="ts">
defineProps<{
    colorClasses: string;
}>();
</script>

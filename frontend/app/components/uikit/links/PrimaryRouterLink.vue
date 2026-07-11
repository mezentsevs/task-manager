<template>
    <BaseRouterLink :to class="text-blue-500 dark:text-gray-200">
        <slot />
    </BaseRouterLink>
</template>

<script setup lang="ts">
import BaseRouterLink from '~/components/uikit/links/BaseRouterLink.vue';
import type { UikitRouterLinkTo } from '~/types/UikitTypes';

withDefaults(
    defineProps<{
        to?: UikitRouterLinkTo;
    }>(),
    {
        to: '/',
    },
);
</script>

<template>
    <BaseButton
        :type
        class="border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 shadow-sm">
        <slot />
    </BaseButton>
</template>

<script setup lang="ts">
import { Button } from '~/enums/UikitEnums';
import BaseButton from '~/components/uikit/buttons/BaseButton.vue';
import type { UikitButton } from '~/types/UikitTypes';

withDefaults(
    defineProps<{
        type?: UikitButton;
    }>(),
    {
        type: Button.Button,
    },
);
</script>

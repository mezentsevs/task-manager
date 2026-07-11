<template>
    <BaseButton :type class="bg-blue-500 dark:bg-gray-200">
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
        type: Button.Submit,
    },
);
</script>

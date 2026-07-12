<template>
    <BaseCard>
        <template #base-logo>
            <slot name="logo" />
        </template>
        <slot />
    </BaseCard>
</template>

<script setup lang="ts">
import BaseCard from '~/components/partials/cards/BaseCard.vue';
</script>

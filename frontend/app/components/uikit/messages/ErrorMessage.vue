<template>
    <BaseMessage v-if="message" class="text-red-500">
        {{ message }}
    </BaseMessage>
</template>

<script setup lang="ts">
import BaseMessage from '~/components/uikit/messages/BaseMessage.vue';

defineProps<{
    message: string;
}>();
</script>

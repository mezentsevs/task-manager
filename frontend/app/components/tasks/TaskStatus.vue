<template>
    <StatusBadge :color-classes="statusColorMap[status]">
        {{ status }}
    </StatusBadge>
</template>

<script setup lang="ts">
import type { TaskStatus as TaskStatusEnum } from '~/enums/TaskEnums';
import StatusBadge from '~/components/uikit/badges/StatusBadge.vue';

defineProps<{
    status: TaskStatusEnum;
}>();

const statusColorMap: Record<TaskStatusEnum, string> = {
    pending: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
    in_progress: 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
    completed: 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
};
</script>

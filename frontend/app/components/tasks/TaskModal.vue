<template>
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg dark:bg-gray-800">
            <h2 class="mb-4 text-xl font-bold text-gray-800 dark:text-gray-100">
                {{ isEditing ? 'Edit Task' : 'New Task' }}
            </h2>
            <form @submit.prevent="handleSubmit">
                <InputLabel for="title" value="Title" />
                <Input id="title" v-model="form.title" v-focus class="mb-4 w-full" required />
                <InputLabel for="description" value="Description" />
                <Input id="description" v-model="form.description" class="mb-4 w-full" />
                <InputLabel for="due_date" value="Due Date" />
                <Input id="due_date" v-model="form.due_date" type="date" class="mb-4 w-full" />
                <InputLabel for="status" value="Status" />
                <select
                    id="status"
                    v-model="form.status"
                    class="mb-4 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md px-3 py-2 shadow-sm">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
                <div class="flex justify-end gap-2">
                    <button
                        type="button"
                        class="border-gray-300 text-gray-700 dark:border-gray-600 dark:text-gray-300 rounded-md border px-4 py-2"
                        @click="$emit('close')">
                        Cancel
                    </button>
                    <PrimaryButton type="submit">Save</PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { reactive, computed } from 'vue';
import Input from '~/components/uikit/inputs/Input.vue';
import InputLabel from '~/components/uikit/inputs/partials/InputLabel.vue';
import PrimaryButton from '~/components/uikit/buttons/PrimaryButton.vue';

import type { Task } from '~/types/TaskTypes';

const props = defineProps<{
    task: Task | null;
}>();

const emit = defineEmits<{
    close: [];
    save: [data: { title: string; description?: string; due_date?: string; status: string }];
}>();

const isEditing = computed<boolean>(() => props.task !== null);

const form = reactive<{
    title: string;
    description: string;
    due_date: string;
    status: string;
}>({
    title: props.task?.title ?? '',
    description: props.task?.description ?? '',
    due_date: props.task?.due_date ?? '',
    status: props.task?.status ?? 'pending',
});

const handleSubmit = (): void => {
    emit('save', {
        title: form.title,
        description: form.description || undefined,
        due_date: form.due_date || undefined,
        status: form.status,
    });
};
</script>

<template>
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg dark:bg-gray-800">
            <Heading :level="2" class="text-xl mb-4">
                {{ isEditing ? 'Edit Task' : 'New Task' }}
            </Heading>
            <ErrorMessage :message="serverError" />
            <form @submit.prevent="handleSubmit">
                <InputLabel for="title" value="Title" />
                <Input id="title" v-model="form.title" v-focus class="mb-4 w-full" required />

                <InputLabel for="description" value="Description" />
                <Textarea id="description" v-model="form.description" class="mb-4 w-full" />

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
                    <SecondaryButton type="button" @click="$emit('close')">Cancel</SecondaryButton>
                    <PrimaryButton type="submit">Save</PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { reactive, computed } from 'vue';
import { toDateInputFormat } from '~/helpers/DateHelper';
import ErrorMessage from '~/components/uikit/messages/ErrorMessage.vue';
import Heading from '~/components/uikit/headings/Heading.vue';
import Input from '~/components/uikit/inputs/Input.vue';
import InputLabel from '~/components/uikit/inputs/partials/InputLabel.vue';
import PrimaryButton from '~/components/uikit/buttons/PrimaryButton.vue';
import SecondaryButton from '~/components/uikit/buttons/SecondaryButton.vue';
import Textarea from '~/components/uikit/inputs/Textarea.vue';

import type { Task } from '~/types/TaskTypes';

const props = defineProps<{
    task: Task | null;
    serverError: string;
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
    due_date: toDateInputFormat(props.task?.due_date),
    status: props.task?.status ?? 'pending',
});

const vFocus = {
    mounted: (el: HTMLElement) => el.focus(),
};

const handleSubmit = (): void => {
    emit('save', {
        title: form.title,
        description: form.description || undefined,
        due_date: form.due_date || undefined,
        status: form.status,
    });
};
</script>

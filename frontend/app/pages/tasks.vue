<template>
    <div class="min-h-screen bg-gray-100 pt-20 pb-8 dark:bg-gray-900">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <Heading :level="1" class="text-3xl">Tasks</Heading>
                <PrimaryButton class="w-full sm:w-40" @click="openCreateModal">
                    Add Task
                </PrimaryButton>
            </div>

            <div class="mb-4 flex flex-col gap-4 sm:flex-row">
                <Input
                    v-model="searchQuery"
                    placeholder="Search tasks..."
                    class="w-full sm:flex-1"
                    @input="onSearchInput" />
                <select
                    v-model="statusFilter"
                    class="w-full sm:w-40 px-3 py-2 pr-8 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm"
                    @change="() => fetchTasks()">
                    <option value="">All statuses</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div v-if="loading" class="py-4 text-center text-gray-600 dark:text-gray-400">
                Loading...
            </div>
            <div v-else-if="error" class="py-4 text-center text-red-500">
                {{ error }}
            </div>
            <div
                v-else-if="!tasks.length"
                class="py-4 text-center text-gray-600 dark:text-gray-400">
                No tasks found.
            </div>
            <div v-else class="overflow-x-auto rounded-lg bg-white shadow dark:bg-gray-800">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Title
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Status
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Due Date
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr
                            v-for="task in tasks"
                            :key="task.id"
                            class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                {{ task.title }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span
                                    class="rounded-full px-2 py-1 text-xs font-semibold"
                                    :class="statusClass(task.status)">
                                    {{ task.status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ task.due_date ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex gap-2">
                                    <button
                                        v-if="canEdit(task)"
                                        class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300"
                                        @click="openEditModal(task)">
                                        Edit
                                    </button>
                                    <button
                                        v-if="canDelete(task)"
                                        class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                                        @click="handleDelete(task.id)">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="meta.last_page > 1" class="mt-4 flex justify-center">
                <nav class="inline-flex gap-2">
                    <button
                        v-for="page in meta.last_page"
                        :key="page"
                        :disabled="page === meta.current_page"
                        class="rounded px-3 py-1 text-sm border-gray-300 dark:border-gray-600 dark:text-gray-300"
                        :class="{
                            'bg-blue-500 text-white': page === meta.current_page,
                            'border dark:bg-gray-800': page !== meta.current_page,
                        }"
                        @click="goToPage(page)">
                        {{ page }}
                    </button>
                </nav>
            </div>
        </div>

        <TaskModal v-if="showModal" :task="editingTask" @close="closeModal" @save="handleSave" />
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import { useAuthStore } from '~/stores/auth';
import { useTaskStore } from '~/stores/tasks';
import Heading from '~/components/uikit/headings/Heading.vue';
import Input from '~/components/uikit/inputs/Input.vue';
import PrimaryButton from '~/components/uikit/buttons/PrimaryButton.vue';
import TaskModal from '~/components/tasks/TaskModal.vue';

import type { Task, TaskFilters } from '~/types/TaskTypes';

const taskStore = useTaskStore();
const authStore = useAuthStore();

const { tasks, meta, loading, error } = storeToRefs(taskStore);

const searchQuery = ref<string>('');
const statusFilter = ref<TaskFilters['status']>('');
const showModal = ref<boolean>(false);
const editingTask = ref<Task | null>(null);

const fetchTasks = async (page?: number): Promise<void> => {
    const filters: TaskFilters = {
        search: searchQuery.value || undefined,
        status: statusFilter.value || undefined,
        page,
    };
    await taskStore.fetchTasks(filters);
};

const openCreateModal = (): void => {
    editingTask.value = null;
    showModal.value = true;
};

const openEditModal = (task: Task): void => {
    editingTask.value = { ...task };
    showModal.value = true;
};

const closeModal = (): void => {
    showModal.value = false;
    editingTask.value = null;
};

const handleSave = async (taskData: {
    title: string;
    description?: string;
    due_date?: string;
    status: string;
}): Promise<void> => {
    if (editingTask.value) {
        await taskStore.updateTask(editingTask.value.id, taskData);
    } else {
        await taskStore.createTask(taskData);
    }
    closeModal();
    await fetchTasks();
};

const handleDelete = async (taskId: number): Promise<void> => {
    if (confirm('Are you sure?')) {
        await taskStore.deleteTask(taskId);
        await fetchTasks();
    }
};

const goToPage = (page: number): void => {
    fetchTasks(page);
};

const canEdit = (task: Task): boolean => {
    return (
        authStore.user?.id === task.user_id || (authStore.user?.roles?.includes('admin') ?? false)
    );
};

const canDelete = (task: Task): boolean => {
    return (
        authStore.user?.id === task.user_id || (authStore.user?.roles?.includes('admin') ?? false)
    );
};

const statusClass = (status: string): string => {
    switch (status) {
        case 'pending':
            return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
        case 'in_progress':
            return 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
        case 'completed':
            return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
        default:
            return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
    }
};

const onSearchInput = (): void => {
    // debounce not implemented yet, simple refresh
    fetchTasks();
};

onMounted(() => {
    fetchTasks();
});
</script>

import { defineStore } from 'pinia';
import axios from 'axios';

import type { Task, TaskFilters, TaskPaginationMeta } from '~/types/TaskTypes';

interface TaskState {
    tasks: Task[];
    meta: TaskPaginationMeta;
    loading: boolean;
    error: string | null;
    currentTask: Task | null;
}

export const useTaskStore = defineStore('task', {
    state: (): TaskState => ({
        tasks: [],
        meta: {
            current_page: 1,
            last_page: 1,
            per_page: 10,
            total: 0,
        },
        loading: false,
        error: null,
        currentTask: null,
    }),
    actions: {
        async fetchTasks(filters: TaskFilters = {}): Promise<void> {
            this.loading = true;
            this.error = null;
            try {
                const params = new URLSearchParams();
                if (filters.status) params.append('status', filters.status);
                if (filters.search) params.append('search', filters.search);
                if (filters.sort_by) params.append('sort_by', filters.sort_by);
                if (filters.order) params.append('order', filters.order);
                if (filters.page) params.append('page', String(filters.page));

                const response = await axios.get<{
                    data: Task[];
                    current_page: number;
                    last_page: number;
                    per_page: number;
                    total: number;
                }>(`/tasks?${params.toString()}`);

                this.tasks = response.data.data;
                this.meta = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page,
                    per_page: response.data.per_page,
                    total: response.data.total,
                };
            } catch {
                this.error = 'Failed to load tasks';
            } finally {
                this.loading = false;
            }
        },
        async createTask(taskData: {
            title: string;
            description?: string;
            due_date?: string;
            status: string;
        }): Promise<Task | null> {
            this.error = null;
            try {
                const response = await axios.post<{ message: string; task: Task }>(
                    '/tasks',
                    taskData,
                );
                this.tasks.push(response.data.task);
                return response.data.task;
            } catch {
                this.error = 'Failed to create task';
                return null;
            }
        },
        async updateTask(
            taskId: number,
            taskData: {
                title: string;
                description?: string;
                due_date?: string;
                status: string;
            },
        ): Promise<Task | null> {
            this.error = null;
            try {
                const response = await axios.put<{ message: string; task: Task }>(
                    `/tasks/${taskId}`,
                    taskData,
                );
                const index = this.tasks.findIndex(t => t.id === taskId);
                if (index !== -1) {
                    this.tasks[index] = response.data.task;
                }
                return response.data.task;
            } catch {
                this.error = 'Failed to update task';
                return null;
            }
        },
        async deleteTask(taskId: number): Promise<boolean> {
            this.error = null;
            try {
                await axios.delete(`/tasks/${taskId}`);
                this.tasks = this.tasks.filter(t => t.id !== taskId);
                return true;
            } catch {
                this.error = 'Failed to delete task';
                return false;
            }
        },
        setCurrentTask(task: Task | null): void {
            this.currentTask = task;
        },
    },
});

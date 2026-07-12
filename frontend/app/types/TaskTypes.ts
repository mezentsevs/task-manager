export interface Task {
    id: number;
    user_id: number;
    title: string;
    description: string | null;
    due_date: string | null;
    status: TaskStatus;
    created_at: string;
    updated_at: string;
}

export type TaskStatus = 'pending' | 'in_progress' | 'completed';

export interface TaskFilters {
    status?: TaskStatus | '';
    search?: string;
    sort_by?: string;
    order?: 'asc' | 'desc';
    page?: number;
}

export interface TaskPaginationMeta {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

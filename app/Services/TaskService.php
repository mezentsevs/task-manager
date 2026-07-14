<?php

namespace App\Services;

use App\Dtos\TaskStoreDto;
use App\Dtos\TaskUpdateDto;
use App\Enums\Role;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService
{
    public function list(array $filters): LengthAwarePaginator
    {
        $query = Task::query();

        if (!auth()->user()->hasRole(Role::Admin)) {
            $query->where('user_id', auth()->id());
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }

        $sortBy = $filters['sort_by'] ?? 'created_at';
        $order = $filters['order'] ?? 'desc';
        $query->orderBy($sortBy, $order);
        $query->orderBy('id', 'desc');

        return $query->paginate(10);
    }

    public function store(TaskStoreDto $dto): Task
    {
        return Task::create([
            'user_id' => auth()->id(),
            'title' => $dto->title,
            'description' => $dto->description,
            'due_date' => $dto->dueDate,
            'status' => $dto->status,
        ]);
    }

    public function update(Task $task, TaskUpdateDto $dto): Task
    {
        $task->update([
            'title' => $dto->title,
            'description' => $dto->description,
            'due_date' => $dto->dueDate,
            'status' => $dto->status,
        ]);

        return $task;
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}

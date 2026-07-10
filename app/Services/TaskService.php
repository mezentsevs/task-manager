<?php

namespace App\Services;

use App\Dtos\CreateTaskDto;
use App\Dtos\UpdateTaskDto;
use App\Enums\Role;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService
{
    public function list(array $filters): LengthAwarePaginator
    {
        $query = Task::query();

        if (auth()->user()->hasRole(Role::Admin)) {
            // Admin sees all tasks
        } else {
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

        return $query->paginate(10);
    }

    public function store(CreateTaskDto $dto): Task
    {
        return Task::create([
            'user_id' => auth()->id(),
            'title' => $dto->title,
            'description' => $dto->description,
            'due_date' => $dto->dueDate,
            'status' => $dto->status,
        ]);
    }

    public function update(Task $task, UpdateTaskDto $dto): Task
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

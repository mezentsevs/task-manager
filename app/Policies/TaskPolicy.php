<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function viewAny(User $user): bool
    {
        return auth()->check();
    }

    public function view(User $user, Task $task): bool
    {
        return $user->hasRole(Role::Admin) || $user->id === $task->user_id;
    }

    public function create(User $user): bool
    {
        return auth()->check();
    }

    public function update(User $user, Task $task): bool
    {
        return $user->hasRole(Role::Admin) || $user->id === $task->user_id;
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->hasRole(Role::Admin) || $user->id === $task->user_id;
    }
}

<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskStatus;
use App\Http\Requests\BaseRequest;
use App\Models\Task;
use Illuminate\Validation\Rule;

class TaskStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Task::class);
    }

    public function rules(): array
    {
        return [
            'title' => 'bail|required|string|min:3|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => ['bail', 'required', 'string', Rule::in(TaskStatus::values())],
        ];
    }
}

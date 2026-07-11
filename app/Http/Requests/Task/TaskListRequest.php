<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;
use App\Models\Task;

class TaskListRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Task::class);
    }
}

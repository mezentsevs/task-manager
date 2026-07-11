<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;

class TaskShowRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('view', $this->route('task'));
    }
}

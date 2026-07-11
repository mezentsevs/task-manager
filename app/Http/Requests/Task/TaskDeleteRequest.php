<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;

class TaskDeleteRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('delete', $this->route('task'));
    }
}

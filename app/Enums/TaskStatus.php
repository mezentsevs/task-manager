<?php

namespace App\Enums;

use App\Traits\Enums\HasValues;

enum TaskStatus: string
{
    use HasValues;

    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';
}

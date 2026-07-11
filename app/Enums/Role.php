<?php

namespace App\Enums;

use App\Traits\Enums\HasValues;

enum Role: string
{
    use HasValues;

    case User = 'user';
    case Admin = 'admin';
}

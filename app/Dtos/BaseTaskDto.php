<?php

namespace App\Dtos;

abstract class BaseTaskDto extends BaseDto
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $description,
        public readonly ?string $dueDate,
        public readonly string $status,
    ) {
    }
}

<?php

namespace App\Traits\Enums;

/**
 * @method static array cases()
 */
trait HasValues
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

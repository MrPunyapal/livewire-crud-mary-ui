<?php

namespace App\Enums;

enum FeaturedStatus: int
{
    case NOT_FEATURED = 0;
    case FEATURED = 1;

    public function label(): string
    {
        return match ($this) {
            self::NOT_FEATURED => 'No',
            self::FEATURED => 'Yes',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::NOT_FEATURED => 'badge-error',
            self::FEATURED => 'badge-success',
        };
    }
}

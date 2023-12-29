<?php

namespace App\Config;

enum SheetType
{
    case MINE;
    case SHARE;

    public function getName(): string
    {
        return match ($this) {
            self::MINE => '自分のお金',
            self::SHARE => 'お金'
        };
    }
}

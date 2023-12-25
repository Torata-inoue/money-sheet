<?php

namespace App\Config;

enum CSVType
{
//    case UFJ;
    case RAKUTEN_BANK;
//    case RAKUTEN_MINE;
//    case RAKUTEN_SHARE;

    public function getCharacterCode(): string
    {
        return match ($this) {
//            self::UFJ => 'Shift-JIS',
            self::RAKUTEN_BANK => 'Shift-JIS',
//            self::RAKUTEN_MINE => 'UTF-8',
//            self::RAKUTEN_SHARE => 'UTF-8',
        };
    }

    public function getFileName(): string
    {
        return match ($this) {
//            self::UFJ => 'ufj.csv',
            self::RAKUTEN_BANK => 'rakuten_bank.csv',
//            self::RAKUTEN_MINE => 'rakuten_7271.csv',
//            self::RAKUTEN_SHARE => 'rakuten_1560.csv',
        };
    }
}

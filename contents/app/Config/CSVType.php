<?php

namespace App\Config;

use App\Domains\History\HistoryInterface;
use App\Domains\History\RakutenBankHistory;
use App\Domains\History\RakutenCardHistory;

enum CSVType
{
    case RAKUTEN_BANK;
    case RAKUTEN_MINE;
    case RAKUTEN_SHARE;

    public function getCharacterCode(): string
    {
        return match ($this) {
            self::RAKUTEN_BANK => 'Shift-JIS',
            self::RAKUTEN_MINE => 'UTF-8',
            self::RAKUTEN_SHARE => 'UTF-8',
        };
    }

    public function getFileName(): string
    {
        return match ($this) {
            self::RAKUTEN_BANK => 'rakuten_bank.csv',
            self::RAKUTEN_MINE => 'rakuten_7271.csv',
            self::RAKUTEN_SHARE => 'rakuten_1560.csv',
        };
    }

    /**
     * @return class-string<HistoryInterface>
     */
    public function getHistoryClass(): string
    {
        return match ($this) {
            self::RAKUTEN_BANK => RakutenBankHistory::class,
            self::RAKUTEN_MINE => RakutenCardHistory::class,
            self::RAKUTEN_SHARE => RakutenCardHistory::class,
        };
    }

    public function getCardName(): string
    {
        return match ($this) {
            self::RAKUTEN_BANK => 'Rakuten デビットMaster',
            self::RAKUTEN_MINE => 'Rakuten Visa 7271',
            self::RAKUTEN_SHARE => 'Rakuten Visa 1560',
        };
    }

    public function getSheetType(): string
    {
        return match ($this) {
            self::RAKUTEN_BANK => SheetType::SHARE->getName(),
            self::RAKUTEN_MINE => SheetType::MINE->getName(),
            self::RAKUTEN_SHARE => SheetType::SHARE->getName(),
        };
    }
}

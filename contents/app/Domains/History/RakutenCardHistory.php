<?php

namespace App\Domains\History;

use Carbon\Carbon;

class RakutenCardHistory implements HistoryInterface
{
    const TRADING_DAY = 0;
    const CONTENT = 1;
    const MONEY = 4;

    private string $trading_day;
    private string $money;
    private string $content;

    public function __construct(array $row, private string $card_name)
    {
        $this->trading_day = $row[self::TRADING_DAY];
        $this->money = $row[self::MONEY];
        $this->content = $row[self::CONTENT];
    }

    public function getTradingDate(): Carbon
    {
        return Carbon::createFromFormat('Y/m/d', $this->trading_day);
    }

    public function getClassification(): string
    {
        return '出金';
    }

    public function getMoney(): int
    {
        return (int) $this->money;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function isDescribe(): bool
    {
        return true;
    }

    public static function skipRow(array $row): bool
    {
        return empty($row[0]);
    }

    public function getCardName(): string
    {
        return $this->card_name;
    }
}

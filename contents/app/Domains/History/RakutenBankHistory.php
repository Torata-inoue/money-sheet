<?php

namespace App\Domains\History;

use Carbon\Carbon;

readonly class RakutenBankHistory implements HistoryInterface
{
    const TRADING_DAY = 0;
    const MONEY = 1;
    const CONTENT = 3;

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
        return Carbon::createFromFormat('Ymd', $this->trading_day);
    }

    public function getClassification(): string
    {
        if ($this->money > 0) {
            return '入金';
        }
        return '出金';
    }

    public function getMoney(): int
    {
        return (int) abs($this->money);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function isDescribe(): bool
    {
        return str_starts_with($this->content, 'Mastercardデビット');
    }

    public static function skipRow(array $row): bool
    {
        return $row[0] === '取引日';
    }

    public function getCardName(): string
    {
        return $this->card_name;
    }
}

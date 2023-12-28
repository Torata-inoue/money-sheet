<?php

namespace App\Domains\History;

use Carbon\Carbon;

interface HistoryInterface
{
    public function __construct(array $row, string $card_name);

    public function getCardName(): string;

    public function getTradingDate(): Carbon;

    /**
     * @return '入金' | '出金'
     */
    public function getClassification(): string;

    public function getMoney(): int;

    public function getContent(): string;

    public function isDescribe(): bool;

    public static function skipRow(array $row): bool;
}

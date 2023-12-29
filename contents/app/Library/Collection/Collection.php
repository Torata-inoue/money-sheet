<?php

namespace App\Library\Collection;

use App\Domains\History\HistoryInterface;

class Collection
{
    /**
     * @param string $key
     * @param array<int, HistoryInterface> $items
     */
    public function __construct(
        public string $key,
        public array $items = []
    ) {
    }

    /**
     * @param array<int, HistoryInterface> $items
     * @return void
     */
    public function merge(array $items): void
    {
        $this->items = array_merge($this->items, $items);
    }

    public function toArray(): array
    {
        $this->sortByDate();
        return array_map(fn (HistoryInterface $history) => $history->toArray(), $this->items);
    }

    private function sortByDate(): void
    {
        usort($this->items, function (HistoryInterface $a, HistoryInterface $b) {
            return $a->getTradingDate()->format('Ymd') <=> $b->getTradingDate()->format('Ymd');
        });
    }
}

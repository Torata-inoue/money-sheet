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
}

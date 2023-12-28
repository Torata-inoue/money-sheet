<?php

namespace App\Library\Provider;

use App\Library\Collection\Collection;

class CollectionProvider
{
    /**
     * @var array<string, Collection>
     */
    private array $collections;

    public function singleton(string $key): Collection
    {
        if (isset($this->collections[$key])) {
            return $this->collections[$key];
        }

        $collection = new Collection($key);
        $this->collections[$key] = $collection;

        return $collection;
    }
}

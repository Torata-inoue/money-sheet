<?php

namespace App\Services;

use App\Config\CSVType;
use App\Library\Parser\CSVParser;
use App\Library\Provider\CollectionProvider;
use Carbon\Carbon;

class Service
{
    public function __construct(private CollectionProvider $provider)
    {
    }

    public function exec()
    {
        $carbon = Carbon::parse('2023-11-01');
        foreach (CSVType::cases() as $type) {
            $collection = $this->provider->singleton($type->getSheetType());
            $parser = new CSVParser($type);
            $collection->merge($parser->parse($carbon));
        }

        var_dump($this->provider);
    }
}

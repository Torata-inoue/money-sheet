<?php

namespace App\Services;

use App\Config\CSVType;
use App\Config\SheetType;
use App\Domains\Sheet\SheetRepository;
use App\Library\Parser\CSVParser;
use App\Library\Provider\CollectionProvider;
use Carbon\Carbon;

readonly class Service
{
    public function __construct(
        private CollectionProvider $provider,
        private SheetRepository $sheetRepository
    ) {
    }

    public function exec(): void
    {
        $carbon = Carbon::parse('2023-11-01');
        foreach (CSVType::cases() as $type) {
            $collection = $this->provider->singleton($type->getSheetType());
            $parser = new CSVParser($type);
            $collection->merge($parser->parse($carbon));
        }

        foreach (SheetType::cases() as $sheetType) {
            $collection = $this->provider->singleton($sheetType->getName());
//            var_dump($collection->toArray());
            $this->sheetRepository->write($sheetType->getName(), $collection->toArray());
        }
    }
}

<?php

namespace App\Services;

use App\Config\CSVType;
use App\Library\CSVParser;
use Carbon\Carbon;

class Service
{
    public function exec()
    {
        $carbon = Carbon::parse('2023-11-01');
        foreach (CSVType::cases() as $type) {
            $parser = new CSVParser($type);
            $parser->parse($carbon);
        }

    }
}

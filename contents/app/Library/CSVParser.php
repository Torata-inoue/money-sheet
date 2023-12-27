<?php

namespace App\Library;

use App\Config\CSVType;
use Carbon\Carbon;

class CSVParser
{
    public function __construct(private CSVType $type)
    {
    }

    public function parse(Carbon $carbon)
    {
        $dir = __DIR__ . "/../../csv/{$carbon->format('Ym')}/";
        $handle = fopen($dir . $this->type->getFileName(), 'r');
        if ($this->type->getCharacterCode() !== 'UTF-8') {
            stream_filter_append($handle, 'convert.iconv.'.$this->type->getCharacterCode().'/UTF-8//IGNORE');
        }

        $rows = [];
        $remove_header = false;
        while ($row = fgetcsv($handle)) {
            if (!$remove_header) {
                $remove_header = true;
                continue;
            }
            $history_class = $this->type->getHistoryClass();
            $history = new $history_class($row);
            var_dump($history);
        }
    }
}

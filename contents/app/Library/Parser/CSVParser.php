<?php

namespace App\Library\Parser;

use App\Config\CSVType;
use App\Domains\History\HistoryInterface;
use Carbon\Carbon;

readonly class CSVParser
{
    public function __construct(private CSVType $type)
    {
    }

    public function parse(Carbon $carbon): array
    {
        $dir = __DIR__ . "/../../../csv/{$carbon->format('Ym')}/";
        $handle = fopen($dir . $this->type->getFileName(), 'r');
        if ($this->type->getCharacterCode() !== 'UTF-8') {
            stream_filter_append($handle, 'convert.iconv.'.$this->type->getCharacterCode().'/UTF-8//IGNORE');
        }
        $rows = [];
        while ($row = fgetcsv($handle)) {
            /** @var class-string<HistoryInterface> $history_class */
            $history_class = $this->type->getHistoryClass();
            if ($history_class::skipRow($row)) {
                continue;
            }
            $rows[] = new $history_class($row, $this->type->getCardName());
        }
        return $rows;
    }
}

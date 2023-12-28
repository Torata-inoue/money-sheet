<?php

namespace App\Domains\Sheet;

use App\Library\Google\GoogleSheet;

class SheetRepository
{
    private string $sheet_id;
    private \Google_Service_Sheets $service;

    public function __construct()
    {
        $this->service = GoogleSheet::instance();
        $this->sheet_id = env('SHEET_ID');
    }

    public function write(string $sheet_name, array $items): void
    {
        $response = $this->service->spreadsheets_values->get($this->sheet_id, "{$sheet_name}!A1:C");
        $values = $response->getValues();
        $rowCount = $values ? count($values) : 0;

        // データを追加
        $range = "{$sheet_name}!A" . ($rowCount + 1) . ':C';
        $body = new \Google_Service_Sheets_ValueRange(['values' => $items]);
        $params = ['valueInputOption' => 'USER_ENTERED'];
        $this->service->spreadsheets_values->append($this->sheet_id, $range, $body, $params);
    }
}

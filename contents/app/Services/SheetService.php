<?php

namespace App\Services;

use App\Domains\Sheet;

class SheetService
{
    public function exec()
    {
        return (new Sheet())->exec();
    }
}

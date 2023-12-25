<?php

require 'bootstrap/bootstrap.php';

var_dump(env('API_KEY'));
echo (new \App\Domains\Sheet\SheetService())->exec();

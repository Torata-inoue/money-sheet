<?php

require 'vendor/autoload.php';

echo (new \App\Services\SheetService())->exec();

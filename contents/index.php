<?php

require 'bootstrap/bootstrap.php';

(new \App\Services\Service(
    new \App\Library\Provider\CollectionProvider(),
    new \App\Domains\Sheet\SheetRepository()
))->exec();

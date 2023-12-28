<?php

require 'bootstrap/bootstrap.php';

$provider = new \App\Library\Provider\CollectionProvider();
(new \App\Services\Service($provider))->exec();

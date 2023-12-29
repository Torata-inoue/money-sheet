<?php

require 'bootstrap/bootstrap.php';

if (empty($argv[0])) {
    throw new Error('オプションを指定してください');
}
try {
    $carbon = \Carbon\Carbon::createFromFormat('Ymd', $argv[1] . '01');
} catch (Exception) {
    throw new Error('Ym形式で日付を入力してください');
}

(new \App\Services\Service(
    new \App\Library\Provider\CollectionProvider(),
    new \App\Domains\Sheet\SheetRepository()
))->exec($carbon);

<?php

namespace App\Library\Google;

class GoogleSheet
{
    public static function instance(): \Google_Service_Sheets
    {
        $credentials_path = __DIR__ . env('CREDENTIAL_PATH');
        $client = new \Google_Client();
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig($credentials_path);
        return new \Google_Service_Sheets($client);
    }
}

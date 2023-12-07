<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');

$dotenv->load();

if (!function_exists('env')) {
    function env(string $key, mixed $default = null): string
    {
        return $_ENV[$key] ?? $default;
    }
}

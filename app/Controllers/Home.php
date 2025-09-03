<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $dsn = env('database.default.DSN');
        return json_encode(['dsn' => $dsn], JSON_PRETTY_PRINT);
    }
}

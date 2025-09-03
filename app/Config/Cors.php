<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Cors extends BaseConfig
{
    public array $allowedOrigins = ['*']; 
    public array $allowedMethods = ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'];
    public array $allowedHeaders = ['*'];
    public bool $allowCredentials = false;
    public int $maxAge = 0;
}

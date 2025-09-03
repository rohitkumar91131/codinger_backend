<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'        => getenv('DATABASE_DSN'),
        'hostname'   => getenv('DATABASE_HOST'),
        'username'   => getenv('DATABASE_USER'),
        'password'   => getenv('DATABASE_PASS'),
        'database'   => getenv('DATABASE_NAME'),
        'DBDriver'   => 'Postgre',
        'DBPrefix'   => '',
        'pConnect'   => false,
        'DBDebug'    => (ENVIRONMENT !== 'production'),
        'charset'    => 'utf8',
        'port'       => getenv('DATABASE_PORT') ?: 5432,
        'schema'     => 'public',
        'sslmode'    => 'require',
        'dateFormat' => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public array $tests = [
        'DSN'      => '',
        'hostname' => '127.0.0.1',
        'username' => '',
        'password' => '',
        'database' => ':memory:',
        'DBDriver' => 'SQLite3',
        'DBPrefix' => 'db_',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'failover' => [],
    ];

    public function __construct()
    {
        parent::__construct();
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}

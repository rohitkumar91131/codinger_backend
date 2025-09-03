<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'        => '',
        'hostname'   => 'dpg-d2rf1m2dbo4c73d8h2j0-a', // Render internal host
        'username'   => 'root',                         // From Render URL
        'password'   => 'gwJh5MkB19XcNBZzO9cIL2RCxbdhhhr5',
        'database'   => 'codinger',
        'DBDriver'   => 'Postgre',
        'DBPrefix'   => '',
        'pConnect'   => false,
        'DBDebug'    => (ENVIRONMENT !== 'production'),
        'charset'    => 'utf8',
        'port'       => 5432,
        'schema'     => 'public',
        'sslmode'    => 'require',                       // Render requires SSL
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

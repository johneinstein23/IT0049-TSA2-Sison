<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    public string $defaultGroup = 'default';

    public array $default;

    public array $tests;

    public function __construct()
    {
        parent::__construct();
        $this->default = [
            'DSN' => '',
            'hostname' => env('database.default.hostname', 'localhost'),
            'username' => env('database.default.username', 'root'),
            'password' => env('database.default.password', ''),
            'database' => env('database.default.database', 'tasks_today_db'),
            'DBDriver' => env('database.default.DBDriver', 'MySQLi'),
            'DBPrefix' => '', 'pConnect' => false, 'DBDebug' => true,
            'charset' => 'utf8mb4', 'DBCollat' => 'utf8mb4_general_ci',
            'swapPre' => '', 'encrypt' => false, 'compress' => false,
            'strictOn' => false, 'failover' => [],
            'port' => (int) env('database.default.port', 3306),
        ];
        $this->tests = [
            'DSN' => '', 'hostname' => '127.0.0.1', 'username' => '', 'password' => '',
            'database' => ':memory:', 'DBDriver' => 'SQLite3', 'DBPrefix' => 'db_',
            'pConnect' => false, 'DBDebug' => true, 'charset' => 'utf8', 'DBCollat' => '',
            'swapPre' => '', 'encrypt' => false, 'compress' => false, 'strictOn' => true,
            'failover' => [], 'port' => 3306,
        ];
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}

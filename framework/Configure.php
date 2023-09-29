<?php

namespace Yc\framework;

class Configure
{
    protected $configs = [];
    public function __construct(array $env)
    {
        $this->configs = [

            'db' => [
                'dbname' => $env["DB_NAME"],
                'user' => $env['DB_USER'],
                'password' => $env['DB_PASSWORD'],
                'host' => $env["DB_HOST"],
                'driver' => $env['DB_DRIVER'] ?? 'pdo_mysql'
            ]
        ];
    }

    public function __get(string $name)
    {
        return $this->configs[$name] ?? null;
    }
}

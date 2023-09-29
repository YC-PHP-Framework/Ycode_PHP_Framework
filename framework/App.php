<?php

namespace Yc\framework;

use Yc\App\Service\CalculServiceInterface;
use Yc\App\Service\SubstractionOpService;

class App
{
    public static App $instance;
    public Router $router;
    private static Database $DB;
    // private Container $container;

    private function __construct()
    {
        self::$instance = $this;
        $this->router = new Router();
        static::$DB = new Database(new Configure($_ENV));
        // $this->container = new Container();
    }

    public static function DB()
    {
        return static::$DB;
    }

    // public function getContainer()
    // {
    //     return $this->container;
    // }
   

    public function run()
    {
        echo  $this->router->resolve();
    }
}

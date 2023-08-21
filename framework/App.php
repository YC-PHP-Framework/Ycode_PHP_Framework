<?php

namespace Yc\framework;

// I am using 'DI' dependency injenction to pass the 
// [ 'database connection ', 'Router' ] through the Application construction

class App
{
    public static App $instance;
    public Router $router;
    private static Database $DB;
    private Container $container;

    public function __construct()
    {
        self::$instance = $this;
        $this->router = new Router();
        static::$DB = new Database(new Configure($_ENV));
        $this->container = new Container();
    }

    public static function DB()
    {
        return static::$DB;
    }
    public function getContainer()
    {
        return $this->container;
    }

    public function run()
    {
        echo  $this->router->resolve();
    }
}

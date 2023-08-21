<?php



require_once __DIR__ . '/../vendor/autoload.php';
require_once '../routes/web.php';


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// $config = require_once '../config/config.php';


//  I was using 'DI' dependency injenction to pass the database connection object through the Application construction
$app = new \Yc\framework\App();



return $app;

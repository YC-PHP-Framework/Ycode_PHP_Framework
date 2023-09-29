<?php

require_once __DIR__ . '/../vendor/autoload.php';


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

use DI\Container as DIContainer;
use Doctrine\ORM\ORMSetup;
use Yc\framework\Configure;
use Yc\framework\Container;

use function DI\create;


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// replace with path to your own project bootstrap file
// $container = new Container();
$container = new DIContainer();
$container->set(Configure::class, create(Configure::class)->constructor($_ENV));
$container->set(EntityManager::class, fn (Configure $config) => EntityManager::create(
    $config->db,
    ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../app/Entity'])
));
// replace with mechanism to retrieve EntityManager in your app
$entityManager = $container->get(EntityManager::class);

$commands = [
    // If you want to add your own custom console commands,
    // you can do so here.
];

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
    $commands
);

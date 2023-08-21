<?php
require_once __DIR__ . '/vendor/autoload.php';


use Yc\framework\Container;
use Doctrine\ORM\EntityManager;
use App\Service\SubstractionOpService;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;



// replace with mechanism to retrieve EntityManager in your app
$container = new Container();
$test = $container->get(CalculServiceInterface::class);
// $entityManager =  $container->get(EntityManager::class);

$commands = [
    // If you want to add your own custom console commands,
    // you can do so here.
];

// ConsoleRunner::run(
//     new SingleManagerProvider($entityManager),
//     $commands
// );

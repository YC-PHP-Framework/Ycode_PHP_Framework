<?php

require_once __DIR__ . '/../vendor/autoload.php';


use function DI\create;
use Doctrine\ORM\ORMSetup;
use Yc\framework\Configure;

use Yc\framework\Container;
use Doctrine\ORM\EntityManager;
use DI\Container as DIContainer;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\CurrentCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\UpToDateCommand;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;


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

$config = new PhpFile(__DIR__.'/../config/migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders
$dependencyFactory =  DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));

$commands = [
    // If you want to add your own custom console commands,
    // you can do so here.

    new CurrentCommand($dependencyFactory),
    new DumpSchemaCommand($dependencyFactory),
    new ExecuteCommand($dependencyFactory),
    new GenerateCommand($dependencyFactory),
    new LatestCommand($dependencyFactory),
    new MigrateCommand($dependencyFactory),
    new RollupCommand($dependencyFactory),
    new StatusCommand($dependencyFactory),
    new VersionCommand($dependencyFactory),
    new UpToDateCommand($dependencyFactory),
    new SyncMetadataCommand($dependencyFactory),
    new ListCommand($dependencyFactory),
    new DiffCommand($dependencyFactory)
];

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
    $commands
);

<?php

require_once './vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\ORM\ORMSetup;
use Yc\framework\Configure;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = new PhpFile('../migrations.php'); // Or use one of the Doctrine\Migrations\Configuration\Configuration\* loaders

$entityManager = EntityManager::create((new Configure($_ENV))->configs->db,
    ORMSetup::createAttributeMetadataConfiguration([__DIR__ . "/app/Entity"])
);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));

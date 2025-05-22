<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false; // ← IMPORTANT!

$config = Setup::createAnnotationMetadataConfiguration(
    [__DIR__ . '/../src/Entity'],
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);

$connection = [
    'dbname'   => $_ENV['DB_NAME'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host'     => $_ENV['DB_HOST'],
    'driver'   => 'pdo_mysql',
];

$entityManager = EntityManager::create($connection, $config);

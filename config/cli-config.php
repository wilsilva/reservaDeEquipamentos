<?php

use Doctrine\ORM\Tools\Setup;

require 'vendor/autoload.php';

$path = array('app/Models');
$devMode = true;

$config = Setup::createAnnotationMetadataConfiguration($path, $devMode);

$connectionOptions = array(
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'dbname'   => 'db_reservadeequipamentos',
    'user'     => 'root',
    'password' => 'root',
);

$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));
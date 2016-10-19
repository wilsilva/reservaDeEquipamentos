<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 4:02 PM
 */

namespace App\Resources;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

abstract class AbstractResource
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if ($this->entityManager === null) {
            $this->entityManager = $this->createEntityManager();
        }

        return $this->entityManager;
    }

    /**
     * @return EntityManager
     */
    public function createEntityManager()
    {
        $path = array('app/Models');
        $devMode = true;

        $config = Setup::createAnnotationMetadataConfiguration($path, $devMode);

        // define credentials...
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'dbname' => 'db_reservadeequipamentos',
            'user' => 'root',
            'password' => 'root',
        );

        return EntityManager::create($connectionOptions, $config);
    }
}
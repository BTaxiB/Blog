<?php

namespace App;

use App\Context\Context;
use App\Database\Config;
use App\Database\EnvException;
use App\Entity\Entity;
use App\Entity\EntitySet;
use App\Entity\EntitySetException;
use App\Entity\Factory\EntityFactoryException;
use Dotenv\Dotenv;

final class ApplicationFacade
{
    /**
     * @var EntitySet
     */
    private EntitySet $entitySet;

    /**
     * @throws EntityFactoryException
     * @throws EnvException
     */
    public function __construct()
    {
        $config = new Config(Dotenv::createImmutable(__DIR__));
        $context = new Context(sprintf("%s%s", __DIR__, Context::DEFAULT_CONTEXT_FILENAME));
        $this->entitySet = new EntitySet($config, $context);
        $this->entitySet->registerEntities();
    }

    /**
     * @param string $entityName
     * @return Entity
     * @throws EntitySetException
     */
    public function getEntity(string $entityName): Entity
    {
        return $this->entitySet->get($entityName);
    }

    /**
     * @param string $entityName
     * @return Entity
     * @throws EntitySetException
     */
    public static function getStaticEntity(string $entityName): Entity
    {
        return (new self)->entitySet->get($entityName);
    }

    /**
     * @param int $amount
     * @return void
     * @throws EntitySetException
     */
    public function blogDatabaseSeed(int $amount)
    {
        $blogEntity = $this->entitySet->get('blogs');
        for ($i = 0; $i < $amount; $i++) {
            $blogEntity->create([
                'created_at' => date('Y-m-d H:i:s'),
                'title' => "test$i",
                'description' => 'testDesc',
                'paragraph_1' => 'TEST',
            ]);
        }
    }
}


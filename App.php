<?php

namespace App;

use App\Context\Context;
use App\Database\Config;
use App\Model\Entity;
use App\Model\Factory\EntityFactory;
use App\Model\Factory\EntityFactoryException;
use Dotenv\Dotenv;

final class App
{
    /**
     * @var Config
     */
    private Config $config;

    /**
     * @var Context
     */
    private Context $context;

    /**
     * @var EntityFactory
     */
    private EntityFactory $entityFactory;

    public function __construct()
    {
        $this->config = new Config(Dotenv::createImmutable(__DIR__));
        $this->config->setConfig();
        $this->context = new Context(sprintf("%s%s", __DIR__, Context::DEFAULT_CONTEXT_FILENAME));
        $this->entityFactory = new EntityFactory($this->context, $this->config);
    }

    /**
     * @param string $entityName
     * @return Entity
     * @throws EntityFactoryException
     */
    public static function createEntity(string $entityName): Entity
    {
        return (new self)->entityFactory->createEntity($entityName);
    }
}


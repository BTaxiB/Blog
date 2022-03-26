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

    /**
     * @var Entity[]
     */
    private array $entityCollection;

    public function __construct()
    {
        $this->config = new Config(Dotenv::createImmutable(__DIR__));
        $this->config->setConfig();
        $this->context = new Context(sprintf("%s%s", __DIR__, Context::DEFAULT_CONTEXT_FILENAME));
        $this->entityFactory = new EntityFactory($this->context, $this->config);
        $this->loadEntities();
    }

    /**
     * @throws EntityFactoryException
     */
    private function loadEntities(): void
    {
        $contextKeys = $this->context->getContextKeys();

        if ($contextKeys === null) {
            throw new AppException("Content is empty, please provide context.");
        }
        
        foreach ($contextKeys as $key) {
            $this->entityCollection[$key] = $this->entityFactory->createEntity($key);
        }
    }

    /**
     * @param string $entityName
     * @return Entity|null
     * @throws AppException
     */
    public function getEntity(string $entityName): ?Entity
    {
        if (!$this->entityCollection[$entityName]) {
            throw new AppException(sprintf("Entity with a name %s not found.", $entityName));
        }

        return $this->entityCollection[$entityName];
    }
}


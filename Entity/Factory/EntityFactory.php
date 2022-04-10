<?php

namespace App\Entity\Factory;

use App\Context\Context;
use App\Database\Config;
use App\Database\MySQLConnection;
use App\Database\Query\QueryService;
use App\Entity\Entity;

final class EntityFactory implements EntityFactoryInterface
{
    /**
     * @var Context
     */
    private Context $context;

    /**
     * @var Config
     */
    private Config $config;

    /**
     * @param Context $context
     * @param Config $config
     */
    public function __construct(Context $context, Config $config)
    {
        $this->context = $context;
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function createEntity(string $entityName): Entity
    {
        if (!$this->context->offsetExists($entityName)) {
            throw new EntityFactoryException("Cannot create entity, scope not found within the context.");
        }

        return new Entity(
            $entityName,
            new MySQLConnection($this->config),
            new QueryService($this->context)
        );
    }
}

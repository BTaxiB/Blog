<?php

namespace App\Model\Factory;

use App\Context\Context;
use App\Database\Config;
use App\Database\MySQLConnection;
use App\Database\Query\QueryService;
use App\Database\Query\QueryServiceInterface;
use App\Model\Entity;
use PDO;

final class EntityFactory implements EntityFactoryInterface
{
    /**
     * @var Context
     */
    private Context $context;

    /**
     * @var PDO
     */
    private PDO $mysqlConnection;

    /**
     * @var QueryServiceInterface
     */
    private QueryServiceInterface $queryService;

    /**
     * @param Context $context
     * @param Config $config
     */
    public function __construct(Context $context, Config $config)
    {
        $this->context = $context;
        $this->mysqlConnection = new MySQLConnection($config);
        $this->queryService = new QueryService($this->context);
    }

    /**
     * @inheritDoc
     */
    public function createEntity(string $entityName): Entity
    {
        if (!$this->context->offsetExists($entityName)) {
            throw new EntityFactoryException(sprintf("Cannot create entity, scope not found within the context."));
        }

        return new Entity($entityName, $this->mysqlConnection, $this->queryService);
    }
}
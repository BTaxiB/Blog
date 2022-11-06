<?php

namespace App\Infrastructure\Model\Factory;

use App\Domain\Exception\ModelOutOfContextException;
use App\Infrastructure\Context\ContextMap;
use App\Infrastructure\Database\Domain\Configuration\Config;
use App\Infrastructure\Database\Infrastructure\MySQLConnection;
use App\Infrastructure\Database\Infrastructure\Query\QueryBuilderHandler;
use App\Infrastructure\Model\Model;
use App\Infrastructure\Model\ModelFactoryInterface;

final class ModelFactory implements ModelFactoryInterface
{
    /**
     * @var ContextMap
     */
    private ContextMap $contextMap;

    /**
     * @var Config
     */
    private Config $config;

    /**
     * @param ContextMap $contextMap
     * @param Config $config
     */
    public function __construct(ContextMap $contextMap, Config $config)
    {
        $this->contextMap = $contextMap;
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function createModel(string $modelName): Model
    {
        if (!$this->contextMap->offsetExists($modelName)) {
            throw new ModelOutOfContextException();
        }

        return new Model(
            $modelName,
            new MySQLConnection($this->config),
            new QueryBuilderHandler($this->contextMap)
        );
    }
}

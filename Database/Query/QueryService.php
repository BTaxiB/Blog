<?php

namespace App\Database\Query;

use App\Context\ContextInterface;
use App\Database\Query\Builder\QueryBuilderStrategy;

final class QueryService implements QueryServiceInterface
{
    /**
     * @var ContextInterface
     */
    private ContextInterface $context;

    /**
     * @param ContextInterface $context
     */
    public function __construct(ContextInterface $context)
    {
        $this->context = $context;
    }

    /**
     * @inheritDoc
     */
    public function createQuery(QueryBuilderStrategy $strategy, string $tableName, array $target = []): string
    {
        $context = $this->getContextMap($target, $tableName);
        return $strategy->build($tableName, $context);
    }

    /**
     * @param string $tableName
     * @return mixed
     */
    private function getContextMap(array $target, string $tableName): mixed
    {
        $context = $this->context->offsetGet($tableName);
        $contextMap = array_keys(array_diff($target, $context));
        $contextMap = array_flip($contextMap);
        return $contextMap;
    }
}
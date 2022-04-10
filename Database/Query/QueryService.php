<?php

namespace App\Database\Query;

use App\Context\ContextInterface;
use App\Database\Query\Builder\QueryBuilderStrategy;

final class QueryService implements QueryServiceInterface
{
    /**
     * @var ContextInterface
     */
    private ContextInterface $contextMap;

    /**
     * @param ContextInterface $context
     */
    public function __construct(ContextInterface $context)
    {
        $this->contextMap = $context;
    }

    /**
     * @inheritDoc
     */
    public function createQuery(QueryBuilderStrategy $strategy, string $tableName, array $target = []): string
    {
        $context = $this->getContext($target, $tableName);
        return $strategy->build($tableName, $context);
    }

    /**
     * @param array $target
     * @param string $tableName
     * @return array
     */
    private function getContext(array $target, string $tableName): array
    {
        $contextMap = $this->contextMap->offsetGet($tableName);
        $context = array_keys(array_diff($target, $contextMap));
        return array_flip($context);
    }
}

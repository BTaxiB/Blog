<?php

namespace App\Infrastructure\Database\Infrastructure\Query;

use App\Infrastructure\Context\ContextMapInterface;
use App\Infrastructure\Database\Domain\Query\QueryBuilderHandlerInterface;
use App\Infrastructure\Database\Infrastructure\Query\Builder\QueryBuilderStrategy;

final class QueryBuilderHandler implements QueryBuilderHandlerInterface
{
    /**
     * @var ContextMapInterface
     */
    private ContextMapInterface $contextMap;

    /**
     * @param ContextMapInterface $context
     */
    public function __construct(ContextMapInterface $context)
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

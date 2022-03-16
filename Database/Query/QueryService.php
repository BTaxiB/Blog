<?php

namespace App\Database\Query;

use App\Context\Context;
use App\Database\Query\Builder\QueryBuilderStrategy;

final class QueryService implements QueryServiceInterface
{
    /**
     * @var Context
     */
    private Context $context;

    /**
     * @param Context $context
     */
    public function __construct(Context $context)
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
        $context = $this->context->$tableName;
        $contextMap = array_keys(array_diff($target, $context));
        $contextMap = array_flip($contextMap);
        return $contextMap;
    }
}
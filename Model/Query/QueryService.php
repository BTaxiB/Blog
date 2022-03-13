<?php

namespace App\Model\Query;

use App\Context\Context;
use App\Model\Query\Builder\QueryBuilderStrategy;

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
        $context = $this->getContext($target, $tableName);
        return $strategy->build($tableName, $context);
    }

    /**
     * @param string $tableName
     * @return mixed
     */
    private function getContext(array $target, string $tableName): mixed
    {
        $contextMap = $this->context->$tableName;
        $context = array_keys(array_diff($target, $context));
        $context = array_flip($contextMap);
        return $context;
    }
}

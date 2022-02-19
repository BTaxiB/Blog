<?php

namespace App\Model\Query;

use App\Model\Query\Builder\QueryBuilderStrategy;

final class QueryService implements QueryServiceInterface
{
    /**
     * @inheritDoc
     */
    public function createQuery(QueryBuilderStrategy $strategy, array $params): string
    {
        return $strategy->build($params);
    }
}
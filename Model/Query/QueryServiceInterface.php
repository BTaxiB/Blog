<?php

namespace App\Model\Query;

use App\Model\Query\Builder\QueryBuilderStrategy;

interface QueryServiceInterface
{
    /**
     * @param QueryBuilderStrategy $strategy
     * @param array $params
     * @return string
     */
    public function createQuery(QueryBuilderStrategy $strategy, array $params): string;
}
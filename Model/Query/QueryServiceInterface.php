<?php

namespace App\Model\Query;

use App\Model\Query\Builder\QueryBuilderStrategy;

interface QueryServiceInterface
{
    /**
     * @param QueryBuilderStrategy $strategy
     * @param string $tableName
     * @param array $target
     * @return string
     */
    public function createQuery(QueryBuilderStrategy $strategy, string $tableName, array $target = []): string;
}
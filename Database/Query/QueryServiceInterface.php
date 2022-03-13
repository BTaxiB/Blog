<?php

namespace App\Database\Query;

use App\Database\Query\Builder\QueryBuilderStrategy;

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
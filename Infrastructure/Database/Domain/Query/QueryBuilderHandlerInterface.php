<?php

namespace App\Infrastructure\Database\Domain\Query;

use App\Infrastructure\Database\Infrastructure\Query\Builder\QueryBuilderStrategy;

interface QueryBuilderHandlerInterface
{
    /**
     * @param QueryBuilderStrategy $strategy
     * @param string $tableName
     * @param array $target
     *
     * @return string
     */
    public function createQuery(QueryBuilderStrategy $strategy, string $tableName, array $target = []): string;
}
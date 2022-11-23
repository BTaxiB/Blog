<?php

namespace App\Infrastructure\Database\Infrastructure\Query\Builder;

use App\Infrastructure\Database\Domain\Query\QueryCollection;

final class MaxQueryBuilder
{
    /**
     * @param string $tableName
     * @param array $params
     *
     * @return string
     */
    public function __invoke(string $tableName, array $params = []): string
    {
        return sprintf(QueryCollection::Max->getValue(), $params['id'], $tableName);
    }
}

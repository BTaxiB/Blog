<?php

namespace App\Infrastructure\Database\Infrastructure\Query\Builder;

use App\Infrastructure\Database\Domain\Query\QueryCollection;

final class ShowQueryBuilder
{
    /**
     * @param string $tableName
     * @param array $params
     *
     * @return string
     */
    public function __invoke(string $tableName, array $params = []): string
    {
        return sprintf(QueryCollection::Show->getValue(), $tableName);
    }
}

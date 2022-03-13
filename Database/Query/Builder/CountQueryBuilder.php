<?php

namespace App\Database\Query\Builder;

final class CountQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(string $tableName, array $params = []): string
    {
        return sprintf("SELECT COUNT(id) FROM %s", $tableName);
    }
}
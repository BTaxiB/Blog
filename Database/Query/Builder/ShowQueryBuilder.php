<?php

namespace App\Database\Query\Builder;

final class ShowQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(string $tableName, array $params = []): string
    {
        return sprintf("SELECT * FROM %s WHERE id = :id LIMIT 1", $tableName);
    }
}
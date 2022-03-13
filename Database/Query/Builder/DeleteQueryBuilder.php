<?php

namespace App\Database\Query\Builder;

final class DeleteQueryBuilder implements QueryBuilderInterface
{
    /**
     * @param string $tableName
     * @inheritDoc
     */
    public function build(string $tableName, array $params = []): string
    {
        return sprintf("DELETE FROM %s WHERE id = :id", $tableName);
    }
}
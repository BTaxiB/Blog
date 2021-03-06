<?php

namespace App\Database\Query\Builder;

use App\Database\Query\QueryEnum;

final class DeleteQueryBuilder implements QueryBuilderInterface
{
    /**
     * @param string $tableName
     * @inheritDoc
     */
    public function build(string $tableName, array $params = []): string
    {
        return sprintf(QueryEnum::Delete->getValue(), $tableName);
    }
}

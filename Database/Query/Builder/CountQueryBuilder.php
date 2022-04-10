<?php

namespace App\Database\Query\Builder;

use App\Database\Query\QueryEnum;

final class CountQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(string $tableName, array $params = []): string
    {
        return sprintf(QueryEnum::Count->getValue(), $tableName);
    }
}

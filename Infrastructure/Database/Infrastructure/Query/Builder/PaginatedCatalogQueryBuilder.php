<?php

namespace App\Infrastructure\Database\Infrastructure\Query\Builder;

use App\Infrastructure\Database\Domain\Query\QueryBuilderInterface;
use App\Infrastructure\Database\Domain\Query\QueryCollection;

final class PaginatedCatalogQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(string $tableName, array $params = []): string
    {
        return sprintf(QueryCollection::PaginatedCatalog->getValue(), $tableName, $params['limit'], $params['offset']);
    }
}

<?php

namespace App\Infrastructure\Database\Infrastructure\Query\Builder;

use App\Infrastructure\Database\Domain\Query\QueryBuilderInterface;

enum QueryBuilderStrategy implements QueryBuilderInterface
{
    case PaginatedCatalog;
    case Catalog;
    case Insert;
    case Show;
    case Update;
    case Delete;
    case Count;

    /**
     * QueryBuilderStrategy enum fulfills the QueryBuilder contract.
     * @inheritDoc
     */
    public function build(string $tableName, array $params = []): string
    {
        return match ($this) {
            QueryBuilderStrategy::PaginatedCatalog => (new PaginatedCatalogQueryBuilder())($tableName, $params),
            QueryBuilderStrategy::Catalog => (new CatalogQueryBuilder())($tableName, $params),
            QueryBuilderStrategy::Insert => (new InsertQueryBuilder())($tableName, $params),
            QueryBuilderStrategy::Show => (new ShowQueryBuilder())($tableName, $params),
            QueryBuilderStrategy::Update => (new UpdateQueryBuilder())($tableName, $params),
            QueryBuilderStrategy::Delete => (new DeleteQueryBuilder())($tableName, $params),
            QueryBuilderStrategy::Count => (new CountQueryBuilder())($tableName, $params),
        };
    }
}

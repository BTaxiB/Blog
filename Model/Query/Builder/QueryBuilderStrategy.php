<?php

namespace App\Model\Query\Builder;

enum QueryBuilderStrategy implements QueryBuilderInterface
{
    case Insert;
    case Show;
    case Update;
    case Delete;
    case Count;

    /**
     * Enum fulfills the QueryBuilder contract.
     * @inheritDoc
     */
    public function build(string $tableName, array $params = []): string
    {
        return match ($this) {
            QueryBuilderStrategy::Insert => (new InsertQueryBuilder())->build($tableName, $params),
            QueryBuilderStrategy::Show => (new ShowQueryBuilder())->build($tableName, $params),
            QueryBuilderStrategy::Update => (new UpdateQueryBuilder())->build($tableName, $params),
            QueryBuilderStrategy::Delete => (new DeleteQueryBuilder())->build($tableName, $params),
            QueryBuilderStrategy::Count => (new CountQueryBuilder())->build($tableName, $params),
        };
    }
}

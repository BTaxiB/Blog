<?php

namespace App\Model\Query\Builder;

enum QueryBuilderStrategy implements QueryBuilderInterface
{
    case Insert;
    case Show;
    case Update;
    case Delete;

    /**
     * Fulfills the contract.
     * @inheritDoc
     */
    public function build(array $params = []): string
    {
        return match ($this) {
            QueryBuilderStrategy::Insert => (new InsertQueryBuilder())->build($params),
            QueryBuilderStrategy::Show => (new ShowQueryBuilder())->build($params),
            QueryBuilderStrategy::Update => (new UpdateQueryBuilder())->build($params),
            QueryBuilderStrategy::Delete => (new DeleteQueryBuilder())->build($params),
        };
    }
}

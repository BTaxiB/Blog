<?php

namespace App\Model\Query\Builder;

final class DeleteQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(array $params = []): string
    {
        return sprintf("DELETE FROM %s WHERE id = :id", $params['table']);
    }
}
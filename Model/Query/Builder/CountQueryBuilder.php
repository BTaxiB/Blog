<?php

namespace App\Model\Query\Builder;

final class CountQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(array $params = []): string
    {
        return sprintf("SELECT COUNT(id) FROM %s", $params['table']);
    }
}
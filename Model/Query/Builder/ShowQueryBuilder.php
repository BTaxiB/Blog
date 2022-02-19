<?php

namespace App\Model\Query\Builder;

final class ShowQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(array $params = []): string
    {
        return sprintf("SELECT * FROM %s WHERE :id = %d", $params['table'], $params['id']);
    }
}
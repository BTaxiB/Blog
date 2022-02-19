<?php

namespace App\Model\Query\Builder;

interface QueryBuilderInterface
{
    /**
     * @param array $params
     * @return string
     */
    public function build(array $params = []): string;
}
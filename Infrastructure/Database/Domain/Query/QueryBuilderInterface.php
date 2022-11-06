<?php

namespace App\Infrastructure\Database\Domain\Query;

interface QueryBuilderInterface
{
    /**
     * @param string $tableName
     * @param array $params
     *
     * @return string
     */
    public function build(string $tableName, array $params = []): string;
}
<?php

namespace App\Infrastructure\Database\Infrastructure\Query\Builder;

use App\Infrastructure\Database\Domain\Query\QueryCollection;

final class UpdateQueryBuilder
{
    /**
     * @param string $tableName
     * @param array $params
     *
     * @return string
     */
    public function __invoke(string $tableName, array $params = []): string
    {
        return sprintf(
            QueryCollection::Update->getValue(),
            $tableName,
            $this->buildSetValuesString($params)
        );
    }

    /**
     * @param array $params
     *
     * @return string
     */
    private function buildSetValuesString(array $params): string
    {
        $setValues = "";

        foreach ($params as $key => $value) {
            if (end($params) === $value) {
                $setValues .= sprintf("%s = :%s", $key, $key);
            } else {
                $setValues .= sprintf("%s = :%s, ", $key, $key);
            }
        }

        return $setValues;
    }
}

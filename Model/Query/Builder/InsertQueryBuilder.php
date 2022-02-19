<?php

namespace App\Model\Query\Builder;

final class InsertQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(array $params = []): string
    {
        $tableName = $params['table'];
        unset($params['table']);
        return sprintf("INSERT INTO %s SET %s", $tableName, $this->buildSetValuesString($params));
    }

    /**
     * @param array $params
     * @return string
     */
    private function buildSetValuesString(array $params): string
    {
        $setValues = "";

        foreach ($params as $key => $value) {
            if (end($params) === $value) {
                $setValues .= sprintf(":%s = %s", $key, $value);
            } else {
                $setValues .= sprintf(":%s = %s, ", $key, $value);
            }
        }

        return $setValues;
    }
}
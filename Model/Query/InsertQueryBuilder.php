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
        return sprintf("INSERT INTO %s(%s) VALUES(%s)", $tableName, $this->buildColumnsString($params), $this->buildValuesPlaceholderString($params));
    }

    /**
     * @param array $params
     * @return string
     */
    private function buildValuesPlaceholderString(array $params): string
    {
        $placeholders = "";
        foreach ($params as $key => $value) {
            if (end($params) === $value) {
                $placeholders .= ":$key";
            } else {
                $placeholders .= ":$key, ";
            }
        }

        return $placeholders;
    }

    /**
     * @param array $params
     * @return string
     */
    private function buildColumnsString(array $params): string
    {
        $columns = "";
        foreach ($params as $key => $value) {
            if (end($params) === $value) {
                $columns .= "$key";
            } else {
                $columns .= "$key, ";
            }
        }

        return $columns;
    }
}
<?php

namespace App\Infrastructure\Database\Infrastructure\Query\Builder;

use App\Infrastructure\Database\Domain\Query\QueryCollection;

final class InsertQueryBuilder
{
    /**
     * @inheritDoc
     */
    public function __invoke(string $tableName, array $params = []): string
    {
        return sprintf(
            QueryCollection::Insert->getValue(),
            $tableName,
            $this->buildColumnsString($params),
            $this->buildValuesPlaceholderString($params)
        );
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

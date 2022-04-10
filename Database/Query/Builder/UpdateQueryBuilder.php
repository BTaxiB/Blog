<?php

namespace App\Database\Query\Builder;

use App\Database\Query\QueryEnum;

final class UpdateQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(string $tableName, array $params = []): string
    {
        return sprintf(
            QueryEnum::Update->getValue(),
            $tableName,
            $this->buildSetValuesString($params)
        );
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
                $setValues .= sprintf("%s = :%s", $key, $key);
            } else {
                $setValues .= sprintf("%s = :%s, ", $key, $key);
            }
        }

        return $setValues;
    }
}

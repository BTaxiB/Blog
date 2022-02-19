<?php

namespace App\Model\Query\Builder;

final class UpdateQueryBuilder implements QueryBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(array $params = []): string
    {
        $tableName = $params['table'];
        unset($params['table']);
        return sprintf(
            "UPDATE %s SET %s WHERE :id = %d",
            $tableName,
            $this->buildSetValuesString($params),
            $params['id']
        );
    }

    /**
     * @param array $params
     * @return string
     */
    private function buildSetValuesString(array $params): string
    {
        $setValues = "";
        unset($params['id']);

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
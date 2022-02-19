<?php

namespace App\Model;

use App\Model\Query\Builder\QueryBuilderStrategy;
use App\Model\Query\QueryServiceInterface;
use PDO;

abstract class AbstractModel
{
    /**
     * @var string
     */
    protected string $tableName;

    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var QueryServiceInterface
     */
    private QueryServiceInterface $queryService;


    public function __construct(PDO $mysqlConnection, QueryServiceInterface $queryService)
    {
        $this->connection = $mysqlConnection;
        $this->queryService = $queryService;
    }

    /**
     * @param array $row
     * @return bool
     */
    public function create(array $row): bool
    {
        $row['table'] = $this->tableName;
        $sql = $this->queryService->createQuery(QueryBuilderStrategy::Insert, $row);

        $statement = $this->connection->prepare($sql);

        foreach ($row as $key => $value) {
            $statement->bindParam(sprintf(":%s", $key), $value);
        }

        return $statement->execute();
    }

    /**
     * @return bool|string
     */
    public function lastInsertId(): bool|string
    {
        return $this->connection->lastInsertId();
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function show(int $id): ?array
    {
        $sql = $this->queryService->createQuery(
            QueryBuilderStrategy::Show,
            ['id' => $id, 'table' => $this->tableName]
        );

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":id", $id);
        $executed = $statement->execute();

        if (!$executed) {
//            throw
        }


        return $statement->fetch() ?? null;
    }

    /**
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function update(int $id, array $params): bool
    {
        $params['table'] = $this->tableName;
        $sql = $this->queryService->createQuery(QueryBuilderStrategy::Update, $params);

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $id);

        return $statement->execute();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = $this->queryService->createQuery(
            QueryBuilderStrategy::Delete,
            ['id' => $id, 'table' => $this->tableName]
        );

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $id);

        return $statement->execute();
    }


}
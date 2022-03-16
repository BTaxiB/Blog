<?php

namespace App\Model;

use App\Database\Query\Builder\QueryBuilderStrategy;
use App\Database\Query\QueryServiceInterface;
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

    /**
     * @param string $tableName
     * @param PDO $mysqlConnection
     * @param QueryServiceInterface $queryService
     */
    public function __construct(string $tableName, PDO $mysqlConnection, QueryServiceInterface $queryService)
    {
        $this->tableName = $tableName;
        $this->connection = $mysqlConnection;
        $this->queryService = $queryService;
    }

    /**
     * @param array $row
     * @return bool
     */
    public function create(array $row): bool
    {
        $sql = $this->queryService->createQuery(QueryBuilderStrategy::Insert, $this->tableName, $row);
        $statement = $this->connection->prepare($sql);
        foreach ($row as $key => $value) {
            $statement->bindValue(":$key", $value);
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
        $sql = $this->queryService->createQuery(QueryBuilderStrategy::Show, $this->tableName);
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC) ?? null;
    }

    /**
     * @param int $id
     * @param array $row
     * @return bool
     */
    public function update(int $id, array $row): bool
    {
        $sql = $this->queryService->createQuery(QueryBuilderStrategy::Update, $this->tableName, $row);
        $statement = $this->connection->prepare($sql);

        foreach ($row as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->bindValue(":id", $id);

        return $statement->execute();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = $this->queryService->createQuery(QueryBuilderStrategy::Delete, $this->tableName);
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(":id", $id);

        return $statement->execute();
    }

    /**
     * @return bool
     */
    public function count(): bool
    {
        $sql = $this->queryService->createQuery(QueryBuilderStrategy::Count, $this->tableName);
        return $this->connection->prepare($sql)->execute();
    }
}
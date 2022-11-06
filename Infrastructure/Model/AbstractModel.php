<?php

namespace App\Infrastructure\Model;

use App\Infrastructure\Database\Domain\Query\QueryBuilderHandlerInterface;
use App\Infrastructure\Database\Infrastructure\Query\Builder\QueryBuilderStrategy;
use PDO;

abstract class AbstractModel
{
    /** @var string */
    protected string $tableName;

    /** @var PDO */
    private PDO $connection;

    /** @var QueryBuilderHandlerInterface */
    private QueryBuilderHandlerInterface $queryService;

    /**
     * @param string $tableName
     * @param PDO $mysqlConnection
     * @param QueryBuilderHandlerInterface $queryService
     */
    public function __construct(string $tableName, PDO $mysqlConnection, QueryBuilderHandlerInterface $queryService)
    {
        $this->tableName = $tableName;
        $this->connection = $mysqlConnection;
        $this->queryService = $queryService;
    }

    /**
     * @param array $row
     *
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
     *
     * @return array|null|false
     */
    public function show(int $id): mixed
    {
        $sql = $this->queryService->createQuery(QueryBuilderStrategy::Show, $this->tableName);
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC) ?? null;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $sql = $this->queryService->createQuery(QueryBuilderStrategy::Catalog, $this->tableName);
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    public function allPaginated(int $limit, int $offset): array
    {
        $sql = $this->queryService->createQuery(
            QueryBuilderStrategy::PaginatedCatalog,
            $this->tableName,
            ['limit' => $limit, 'offset' => $offset]
        );
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @param array $row
     *
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

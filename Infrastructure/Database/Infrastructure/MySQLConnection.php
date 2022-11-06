<?php

namespace App\Infrastructure\Database\Infrastructure;

use App\Domain\Exception\DatabaseException;
use App\Infrastructure\Database\Domain\Configuration\Config;
use App\Infrastructure\Database\Domain\Configuration\Database;
use PDO;
use PDOException;

final class MySQLConnection extends PDO
{
    private const CONNECTION_FAILED_ERROR = 'Error occurred while trying to connect to database, check database configuration! Error: %s';

    /**
     * @param Config $config
     * @throws DatabaseException
     */
    public function __construct(Config $config)
    {
        try {
            parent::__construct(
                sprintf(
                    "%s:host=%s;dbname=%s",
                    Database::MysqlDatabaseType->getValue(),
                    Database::DatabaseHost->getValue(),
                    $config->getDatabaseName()
                ),
                $config->getUsername(),
                $config->getPassword()
            );
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new DatabaseException(sprintf(self::CONNECTION_FAILED_ERROR, $e->getMessage()));
        }
    }
}
<?php

namespace App\Database;

use PDO;
use PDOException;

final class MySQLConnection extends PDO
{
    private const DATABASE_HOST = 'localhost';
    private const DATABASE_TYPE = 'mysql';

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $connectionString = sprintf("%s:host=%s;dbname=%s",
            self::DATABASE_TYPE,
            self::DATABASE_HOST,
            $config->getDatabaseName()
        );

        try {
            parent::__construct($connectionString, $config->getUsername(), $config->getPassword());
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error occurred while trying to connect to database, check database configuration! Error: ' . $e->getMessage();
        }
    }
}
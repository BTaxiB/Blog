<?php

namespace App\Domain\Exception;

use App\Infrastructure\Database\Domain\Configuration\Config;
use Exception;

final class ConfigException extends Exception
{
    private const ERROR_DB_USER_EMPTY = "Database user value is missing.";
    private const ERROR_DB_PASSWORD_EMPTY = "Database password value is missing.";
    private const ERROR_DB_NAME_EMPTY = "Database name value is missing.";

    /**
     * @param Config $config
     *
     * @return void
     * @throws ConfigException
     */
    public static function assertDBUserValueExists(Config $config): void
    {
        if ($config->getUsername() === "") {
            throw new self(self::ERROR_DB_USER_EMPTY);
        }
    }

    /**
     * @param Config $config
     *
     * @return void
     * @throws ConfigException
     */
    public static function assertDBPasswordValueExists(Config $config): void
    {
        if ($config->getPassword() === "") {
            throw new self(self::ERROR_DB_PASSWORD_EMPTY);
        }
    }

    /**
     * @param Config $config
     *
     * @return void
     * @throws ConfigException
     */
    public static function assertDBNameValueExists(Config $config): void
    {
        if ($config->getDatabaseName() === "") {
            throw new self(self::ERROR_DB_NAME_EMPTY);
        }
    }
}
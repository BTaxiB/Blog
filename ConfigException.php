<?php

namespace App\Database;

use Exception;

final class ConfigException extends Exception
{
    /**
     * @param Config $config
     * @return void
     * @throws ConfigException
     */
    public static function assertDBUserValueExists(Config $config): void
    {
        if ($config->getUsername() === "") {
            throw new self("Database user value is missing.");
        }
    }

    /**
     * @param Config $config
     * @return void
     * @throws ConfigException
     */
    public static function assertDBPasswordValueExists(Config $config): void
    {
        if ($config->getPassword() === "") {
            throw new self("Database password value is missing.");
        }
    }

    /**
     * @param Config $config
     * @return void
     * @throws ConfigException
     */
    public static function assertDBNameValueExists(Config $config): void
    {
        if ($config->getDatabaseName() === "") {
            throw new self("Database name value is missing.");
        }
    }
}
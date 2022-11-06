<?php

namespace App\Domain\Exception;

use Dotenv\Dotenv;
use Exception;

final class BadEnvironmentConfigException extends Exception
{
    const ENV_VAR_NOT_FOUND_ERROR = "Required database environment variables are missing.";

    /**
     * @param Dotenv $env
     *
     * @return void
     * @throws BadEnvironmentConfigException
     */
    public static function assertEnvironmentConfig(Dotenv $env): void
    {
        if (
            !$env->ifPresent('DB_USER') ||
            !$env->ifPresent('DB_PASS') ||
            !$env->ifPresent('DB_NAME')
        ) {
            throw new self(self::ENV_VAR_NOT_FOUND_ERROR);
        }
    }
}

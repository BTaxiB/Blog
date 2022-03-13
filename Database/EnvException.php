<?php

namespace App\Database;

use Dotenv\Dotenv;
use Exception;

final class EnvException extends Exception
{
    /**
     * @return void
     * @throws EnvException
     */
    public static function assertEnvironmentLoad(Dotenv $env): void
    {
        if (
            !$env->ifPresent('DB_USER') ||
            !$env->ifPresent('DB_PASS') ||
            !$env->ifPresent('DB_NAME')
        ){
            throw new self("Database ENV variables are missing.");
        }
    }
}
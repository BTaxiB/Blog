<?php

namespace App\Infrastructure\Database\Domain\Configuration;

use App\Domain\Exception\BadEnvironmentConfigException;
use Dotenv\Dotenv;

final class Config
{
    private const DB_USER_ENV_KEY = 'DB_USER';
    private const DB_PASSWORD_ENV_KEY = 'DB_PASS';
    private const DB_NAME_ENV_KEY = 'DB_NAME';

    /** @var Dotenv */
    private Dotenv $env;

    /** @var string */
    private string $dbUser;

    /** @var mixed */
    private mixed $dbPass;

    /** @var string */
    private string $dbName;

    /** @param Dotenv $env */
    public function __construct(Dotenv $env)
    {
        $this->env = $env;
        $this->env->load();
    }

    /**
     * @return void
     * @throws BadEnvironmentConfigException
     */
    public function setConfig(): void
    {
        BadEnvironmentConfigException::assertEnvironmentConfig($this->env);
        $this->setDatabaseName();
        $this->setDatabaseUser();
        $this->setDatabasePassword();
    }

    /**
     * @return void
     */
    private function setDatabaseUser(): void
    {
        $this->dbUser = getenv(self::DB_USER_ENV_KEY);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->dbUser;
    }

    /**
     * @return void
     */
    private function setDatabasePassword(): void
    {
        $this->dbPass = getenv(self::DB_PASSWORD_ENV_KEY);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->dbPass;
    }

    /**
     * @return void
     */
    private function setDatabaseName(): void
    {
        $this->dbName = getenv(self::DB_NAME_ENV_KEY);
    }

    /**
     * @return string
     */
    public function getDatabaseName(): string
    {
        return $this->dbName;
    }
}
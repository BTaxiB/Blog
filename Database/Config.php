<?php

namespace App\Database;

use Dotenv\Dotenv;

final class Config
{
    /**
     * @var Dotenv
     */
    private Dotenv $env;

    /**
     * @var string
     */
    private string $dbUser;

    /**
     * @var mixed
     */
    private mixed $dbPass;

    /**
     * @var string
     */
    private string $dbName;

    /**
     * @param Dotenv $env
     */
    public function __construct(Dotenv $env)
    {
        $this->env = $env;
        $this->env->load();
    }

    /**
     * @return void
     * @throws EnvException
     */
    public function setConfig(): void
    {
        EnvException::assertEnvironmentLoad($this->env);
        $this->setDatabaseName();
        $this->setDatabaseUser();
        $this->setDatabasePassword();
    }

    /**
     * @return Config
     * @throws EnvException
     */
    private function setDatabaseUser(): void
    {
        $this->dbUser = getenv('DB_USER');
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->dbUser;
    }

    /**
     * @return Config
     * @throws EnvException
     */
    private function setDatabasePassword(): void
    {
        $this->dbPass = getenv('DB_PASS');
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->dbPass;
    }

    /**
     * @return Config
     * @throws EnvException
     */
    private function setDatabaseName(): void
    {
        $this->dbName = getenv('DB_NAME');
    }

    /**
     * @return string
     */
    public function getDatabaseName(): string
    {
        return $this->dbName;
    }
}
<?php

namespace App\Database;

final class Config
{
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
     * @param array $config
     * @return void
     * @throws ConfigException
     */
    public function setConfig(array $config): void
    {
        $this->setDatabaseUser($config['dbUser']);
        $this->setDatabasePassword($config['dbPass']);
        $this->setDatabaseName($config['dbName']);
    }

    /**
     * @param string $dbUser
     * @return Config
     * @throws ConfigException
     */
    public function setDatabaseUser(string $dbUser): Config
    {
        $this->dbUser = $dbUser;
        ConfigException::assertDBUserValueExists($this);
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->dbUser;
    }

    /**
     * @param mixed $dbPass
     * @return Config
     * @throws ConfigException
     */
    public function setDatabasePassword(mixed $dbPass): Config
    {
        $this->dbPass = $dbPass;
//        ConfigException::assertDBPasswordValueExists($this);
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->dbPass;
    }

    /**
     * @param string $dbName
     * @return Config
     * @throws ConfigException
     */
    public function setDatabaseName(string $dbName): Config
    {
        $this->dbName = $dbName;
        ConfigException::assertDBNameValueExists($this);
        return $this;
    }

    /**
     * @return string
     */
    public function getDatabaseName(): string
    {
        return $this->dbName;
    }
}
<?php

namespace App\Infrastructure\Database\Domain\Configuration;

enum Database: string
{
    case DatabaseHost = 'localhost';
    case MysqlDatabaseType = 'mysql';

    /** @return string */
    public function getValue(): string
    {
        return $this->value;
    }
}
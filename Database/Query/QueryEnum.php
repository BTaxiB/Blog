<?php

namespace App\Database\Query;

enum QueryEnum: string
{
    /** DQL **/
    case Catalog = 'SELECT * FROM %s';
    case Show = 'SELECT * FROM %s WHERE id = :id LIMIT 1';
    case Count = 'SELECT COUNT(id) FROM %s';

    /** DML **/
    case Insert = 'INSERT INTO %s(%s) VALUES(%s)';
    case Update = 'UPDATE %s SET %s WHERE id = :id';
    case Delete = 'DELETE FROM %s WHERE id = :id';

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}

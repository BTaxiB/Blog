<?php

namespace App\Infrastructure\Database\Domain\Query;

enum QueryCollection: string
{
    /** DQL **/
    case Catalog = 'SELECT * FROM %s';
    case PaginatedCatalog = 'SELECT * FROM %s LIMIT %d OFFSET %d';
    case Show = 'SELECT * FROM %s WHERE id = :id LIMIT 1';
    case Count = 'SELECT COUNT(id) FROM %s';

    /** DML **/
    case Insert = 'INSERT INTO %s(%s) VALUES(%s)';
    case Update = 'UPDATE %s SET %s WHERE id = :id';
    case Delete = 'DELETE FROM %s WHERE id = :id';

    /** Functions **/
    case Max = 'SELECT MAX(%s) as max_id FROM %s';

    /** Localization */
    case TranslationByType = 'SELECT content FROM %s WHERE  id_blog = :id_blog AND field_name = :field_name AND language = :language';

    /** @return string */
    public function getValue(): string
    {
        return $this->value;
    }
}

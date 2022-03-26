<?php

namespace App\Translation\Repository;

use PDO;

final class ContentTranslationRepository implements ContentTranslationRepositoryInterface
{
    const TABLE_NAME = 'content_translation_map';

    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @param PDO $mysqlConnection
     */
    public function __construct(PDO $mysqlConnection)
    {
        $this->connection = $mysqlConnection;
    }

    /**
     * @inheritDoc
     */
    public function findTranslationByLanguageType(int $idBlog, string $fieldName, string $language): ?string
    {
        $statement = $this->connection
            ->prepare(
            'SELECT 
                    content
                FROM
                    ' . self::TABLE_NAME . '
                WHERE 
                    id_blog = :id_blog AND
                    field_name = :field_name AND
                    language_type = :language'
        );
        $statement->bindParam(':id_blog', $idBlog);
        $statement->bindParam(':field_name', $fieldName);
        $statement->bindParam(':language', $language);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['content'] ?? null;
    }
}
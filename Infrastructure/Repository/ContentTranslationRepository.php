<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\ContentTranslationRepositoryInterface;
use App\Infrastructure\Database\Domain\Query\QueryCollection;
use PDO;

final class ContentTranslationRepository implements ContentTranslationRepositoryInterface
{
    const TABLE_NAME = 'content_translation_map';

    /** @var PDO */
    private PDO $connection;

    /** @param PDO $mysqlConnection */
    public function __construct(PDO $mysqlConnection)
    {
        $this->connection = $mysqlConnection;
    }

    /**
     * @inheritDoc
     */
    public function findTranslationByLanguageType(int $idBlog, string $fieldName, string $language): ?string
    {
        $sql = sprintf(QueryCollection::TranslationByType->getValue(), self::TABLE_NAME);
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id_blog', $idBlog);
        $statement->bindParam(':field_name', $fieldName);
        $statement->bindParam(':language', $language);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['content'] ?? null;
    }
}
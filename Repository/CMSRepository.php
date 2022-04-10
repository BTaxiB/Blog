<?php

namespace App\Repository;

use App\Entity\Entity;
use PDO;

class CMSRepository implements CMSRepositoryInterface
{
    const BLOG_ENTITY_NAME = 'blogs';

    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var Entity[]
     */
    private array $entityCollection;

    /**
     * @param PDO $mysqlConnection
     * @param array $entityCollection
     */
    public function __construct(PDO $mysqlConnection, array $entityCollection)
    {
        $this->connection = $mysqlConnection;
        $this->entityCollection = $entityCollection;
    }

    public function findAllBlogs() {
    }
}

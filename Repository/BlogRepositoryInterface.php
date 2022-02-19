<?php

namespace Repository;

interface BlogRepositoryInterface
{
    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return array|null
     */
    public function findBy(int $id): ?array;
}
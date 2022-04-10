<?php

namespace App\Entity;

interface EntitySetInterface
{
    /**
     * @return void
     * @throws Factory\EntityFactoryException
     */
    public function registerEntities(): void;

    /**
     * @param string $offset
     * @return Entity
     * @throws EntitySetException
     */
    public function get(string $offset): Entity;
}

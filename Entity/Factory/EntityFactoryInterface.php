<?php

namespace App\Entity\Factory;

use App\Entity\Entity;

interface EntityFactoryInterface
{
    /**
     * @param string $entityName
     * @return Entity
     * @throws EntityFactoryException
     */
    public function createEntity(string $entityName): Entity;
}

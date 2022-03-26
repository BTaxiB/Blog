<?php

namespace App\Model\Factory;

use App\Model\Entity;

interface EntityFactoryInterface
{
    /**
     * @param string $entityName
     * @return Entity
     * @throws EntityFactoryException
     */
    public function createEntity(string $entityName): Entity;
}
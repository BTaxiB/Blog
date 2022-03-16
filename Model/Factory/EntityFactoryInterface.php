<?php

namespace App\Model\Factory;

use App\Model\Entity;

interface EntityFactoryInterface
{
    /**
     * @param string $entityName
     * @return Entity
     */
    public function createEntity(string $entityName): Entity;
}
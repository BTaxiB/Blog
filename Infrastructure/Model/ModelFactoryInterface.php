<?php

namespace App\Infrastructure\Model;

use App\Domain\Exception\ModelOutOfContextException;

interface ModelFactoryInterface
{
    /**
     * @param string $modelName
     * @return Model
     * @throws ModelOutOfContextException
     */
    public function createModel(string $modelName): Model;
}

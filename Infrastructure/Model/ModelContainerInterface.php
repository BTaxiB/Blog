<?php

namespace App\Infrastructure\Model;

use App\Domain\Exception\ModelNotFoundException;
use App\Domain\Exception\ModelOutOfContextException;

interface ModelContainerInterface
{
    /**
     * @return void
     * @throws ModelOutOfContextException
     */
    public function loadModelsFromContext(): void;

    /**
     * @param string $offset
     *
     * @return Model
     * @throws ModelNotFoundException
     */
    public function get(string $offset): Model;
}

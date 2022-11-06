<?php

namespace App\Domain\Exception;

use Exception;

final class ModelNotFoundException extends Exception
{
    private const ENTITY_NOT_FOUND_ERROR = "Entity with a name %s not found";

    public function __construct()
    {
        parent::__construct(self::ENTITY_NOT_FOUND_ERROR);
    }
}

<?php

namespace App\Domain\Exception;

use Exception;

final class ModelOutOfContextException extends Exception
{
    private const ERROR_MODEL_OUT_OF_CONTEXT = "Cannot create model, scope not found within the context.";

    public function __construct()
    {
        parent::__construct(self::ERROR_MODEL_OUT_OF_CONTEXT);
    }
}

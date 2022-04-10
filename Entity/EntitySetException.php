<?php

namespace App\Entity;

use Exception;

final class EntitySetException extends Exception
{
    const ENTITY_NOT_FOUND_ERROR = "Entity with a name %s not found";
}

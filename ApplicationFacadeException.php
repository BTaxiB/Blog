<?php

namespace App;

use Exception;

final class ApplicationFacadeException extends Exception
{
    const ENTITY_NOT_FOUND_ERROR = 'Entity with a name %s not found';
    const CLIENT_PAGE_LOAD_FAIL_ERROR = 'Failed to load %s page, reason: %s';
}

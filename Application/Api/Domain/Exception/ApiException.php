<?php

namespace App\Application\Api\Domain\Exception;

use Exception;

class ApiException extends Exception
{
    public const STATUS_404_NOT_FOUND = "HTTP/1.1 404 Not Found";
}
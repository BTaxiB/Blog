<?php

namespace App\Application\Api\Infrastructure;

use App\Api\Endpoint;

class ApiHandler
{
    public function performRequest(Endpoint $endpoint) {
        return $endpoint->execute();
    }
}